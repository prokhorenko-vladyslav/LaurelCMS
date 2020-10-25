<?php


namespace Laurel\CMS\Modules\Auth\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\Mail\Admin\IpAddressConfirmMail;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressIsBlockedException;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Models\IpAddress;
use Laurel\CMS\Modules\Auth\Models\User;
use Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract;
use Throwable;

/**
 * Trait CanProcessIpAddress
 * @package Laurel\CMS\Modules\Auth\Traits
 */
trait CanProcessIpAddress
{
    /**
     * If setting "need to check ip address" has been setted to true, method will check request ip
     * and throw IpAddressNotFoundException (if ip has not been founded) or IpAddressIsBlockedException
     * (if this ip address has been blocked)
     *
     * @param User $user
     * @return bool
     * @throws IpAddressNotFoundException
     * @throws IpAddressIsBlockedException
     */
    public function checkUserIp(User $user)
    {
        if (cms()->module(SettingModuleContract::class)->findOrDefault('security.need_to_check_admin_ip_address', true)) {
            $ipAddress = $user->ipAddresses()->where('ip_address', Request::ip())->first();

            throw_if(!$ipAddress || !$ipAddress->pivot->is_confirmed, IpAddressNotFoundException::class, ...["IpAddress for user with id {$user->id} has not been found"]);
            throw_if($ipAddress->isBlocked(), IpAddressIsBlockedException::class, ...["IpAddress " . Request::ip() . " has been blocked"]);
        }

        return true;
    }

    /**
     * Sends mail with code for ip address confirmation
     *
     * @param string $login
     * @return ServiceResponse
     */
    public function sendIpConfirmMail(string $login) : ServiceResponse
    {
        $confirmationCode = Str::random(64);
        $user = User::findByLogin($login);
        $ipAddress = $user->findIpAddressOrNew(Request::ip());
        $this->updateConfirmation($user, $ipAddress, Hash::make($confirmationCode), Carbon::now()->format('Y-m-d H:i:s'));

        Mail::to($user->email)->send(new IpAddressConfirmMail($confirmationCode));
        return serviceResponse(200, true, 'auth.ip_confirm_mail_sent',[
            'ipAddress' => $ipAddress->ip_address,
            'token' => $this->createApiToken($user)
        ],'You have tried to login using unknown ip address. Please, confirm it.');
    }

    /**
     * Updates confirmation code, it`s status and sending time, when code has been sent to user with specified ip.
     * If ip address is not exists, relation will be created, or updated (if it already exists).
     *
     * @param User $user
     * @param IpAddress $ipAddress
     * @param string|null $confirmationCode
     * @param string|null $confirmationCodeSentAt
     * @param bool $isConfirmed
     */
    protected function updateConfirmation(User $user, IpAddress $ipAddress, ?string $confirmationCode, ?string $confirmationCodeSentAt = null, bool $isConfirmed = false)
    {
        if ($ipAddress->exists) {
            $user->ipAddresses()->updateExistingPivot($ipAddress->id, [
                'confirmation_code' => $confirmationCode,
                'is_confirmed' => $isConfirmed,
                'confirmation_code_sent_at' => $confirmationCodeSentAt
            ]);
        } else {
            $user->ipAddresses()->save($ipAddress, [
                'confirmation_code' => $confirmationCode,
                'is_confirmed' => $isConfirmed,
                'confirmation_code_sent_at' => $confirmationCodeSentAt
            ]);
        }
    }

    /**
     * Checks expires time of the confirmation code and calls method for updating ip confirmation
     *
     * @param string $login
     * @param string $ipAddress
     * @param string $code
     * @return ServiceResponse
     * @throws Throwable
     */
    public function confirmIpAddress(string $login, string $ipAddress, string $code)
    {
        $user = User::findByLogin($login);

        if ($user) {
            $ipAddress = $user->ipAddresses()->where('ip_address', $ipAddress)->first();

            if ($ipAddress && $ipAddress->pivot->confirmation_code_sent_at) {
                $confirmationCodeSentAt = Carbon::createFromFormat('Y-m-d H:i:s', $ipAddress->pivot->confirmation_code_sent_at);
                $diffInMinutes = $confirmationCodeSentAt->diffInMinutes(now(), false);

                if (
                    Hash::check($code, $ipAddress->pivot->confirmation_code) &&
                    $diffInMinutes <= cms()->module(SettingModuleContract::class)->findOrDefault('admin.ip_address.ip_confirmation_code_expires_in_minutes', 15)
                ) {
                    $this->updateConfirmation($user, $ipAddress, null, null, true);
                    return serviceResponse(200, true, 'auth.ip_confirmed');
                }
            }
        }

        return serviceResponse(404, false, 'auth.ip_not_found');
    }
}
