<?php


namespace Laurel\CMS\Modules\Auth\Traits;


use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Laurel\CMS\Mail\Admin\PasswordResetMail;
use Laurel\CMS\Modules\Auth\Exceptions\PasswordIncorrectException;
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

    public function sendResetPasswordEmail(string $email)
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
}
