<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use Config;

class ActivateDeviceEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $app_mail_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->app_mail_url = Config::get('app.app_mail_url');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails/activatedevice');
        return $this->to($this->order->user->email)
                ->subject('Device activation');
    }
}
