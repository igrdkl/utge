<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ServicesOrder;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;


    public $servicesOrder;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ServicesOrder $servicesOrder)
    {
        $this->servicesOrder = $servicesOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.email.serviceOrder',['servicesOrder' => $this->servicesOrder]);
    }
}
