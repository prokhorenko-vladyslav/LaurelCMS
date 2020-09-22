<?php


namespace Laurel\CMS\Modules\Auth\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\Mail\Admin\PasswordResetMail;
use Laurel\CMS\Modules\Auth\Exceptions\PasswordIncorrectException;
use Laurel\CMS\Modules\Auth\Models\PasswordReset;
use Laurel\CMS\Modules\Auth\Models\Token;
use Laurel\CMS\Modules\Auth\Models\User;

/**
 * Trait CanProcessPassword
 * @package Laurel\CMS\Modules\Auth\Traits
 */
trait CanProcessPassword
{
    /**
     * @param User $user
     * @param string $password
     * @throws PasswordIncorrectException
     */
    public function checkUserPassword(User $user, string $password)
    {
        throw_if(
            !Hash::check($password, $user->password),
            PasswordIncorrectException::class,
            ...['Password is incorrect']
        );
    }

    public function sendResetPasswordMail(string $email)
    {
        $user = User::findByEmail($email);

        if ($user) {
            Password::deleteToken($user);
            $token = Password::createToken($user);

            if ($token) {
                Mail::to($user->email)->send(new PasswordResetMail($token));
            }
            return serviceResponse(200, true, 'auth.email_for_reset_password_sent', [], 'Email with reset password code has been sent');
        }

        return serviceResponse(500, false, 'auth.email_for_reset_password_not_sent', [], 'Email with reset password code has not been sent. Try again later');
    }

    public function resetPassword(string $email, string $token, string $newPassword)
    {
        $user = User::findByEmail($email);

        if (Password::tokenExists($user, $token)) {
            Password::deleteToken($user);
            $user->password = bcrypt($newPassword);
            $user->save();
            return serviceResponse(200, true, 'auth.password_changed', [], 'Password changed');
        }

        return serviceResponse(500, false, 'auth.token_has_not_been_founded', [], 'Token has not been found or is expired');
    }

    public function unlock(string $password)
    {
        if (
            settingsModule()->setting('admin.lock_admin_panel')
        ) {
            $user = Auth::user();
            $this->checkUserPassword($user, $password);
            $this->resetLockTimeForToken($user->token());
        }

        return serviceResponse(200, true, 'auth.account_unlocked', [], 'Account unlocked');
    }

    protected function resetLockTimeForToken(Token $token)
    {
        $token->lock_at = now()->addMinutes(settingsModule()->setting('admin.lock_after_minutes', 15));
        $token->saveOrFail();
    }

    public function getLockStatus() : ServiceResponse
    {
        if (
        settingsModule()->setting('admin.lock_admin_panel')
        ) {
            $user = Auth::user();
            if (now()->diffInMinutes($user->token()->lock_at, false) >= 0) {
                return serviceResponse(200, true, 'auth.account_not_locked', [], 'Account not locked');
            } else {
                return serviceResponse(401, false, 'auth.account_locked', [], 'Account locked');
            }
        } else {
            return serviceResponse(200, true, 'auth.account_not_locked', [], 'Account not locked');
        }
    }
}
