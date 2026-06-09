<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use SerializesModels;

    public function __construct(public Order $order) {}

    public function build()
    {
        return $this
            ->subject('Mise à jour de votre commande #' . $this->order->id)
            ->view('emails.order-status-updated');
    }
}   