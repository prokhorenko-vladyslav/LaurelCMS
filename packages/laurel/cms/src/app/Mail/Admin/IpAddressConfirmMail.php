<?php

namespace Laurel\CMS\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IpAddressConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $confirmationCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.ip_confirm', [
            'confirmationCode' => $this->confirmationCode
        ]);
    }
}
