<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Config;

class ActivateAccountEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $app_mail_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->app_mail_url = Config::get('app.app_mail_url');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails/activateaccount');
        return $this->to($this->user->email)
                ->subject('Account activation');
    }
}
