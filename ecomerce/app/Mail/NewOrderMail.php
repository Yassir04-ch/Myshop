<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable
{
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Nouvelle Commande')
            ->view('emails.new-order');
    }
}