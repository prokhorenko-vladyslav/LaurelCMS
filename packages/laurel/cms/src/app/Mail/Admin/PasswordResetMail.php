<?php

namespace Laurel\CMS\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $passwordResetToken;

    /**
     * Create a new message instance.
     *
     * @param string $passwordResetToken
     */
    public function __construct(string $passwordResetToken)
    {
        $this->passwordResetToken = $passwordResetToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.password_reset', [
            'passwordResetToken' => $this->passwordResetToken
        ]);
    }
}
