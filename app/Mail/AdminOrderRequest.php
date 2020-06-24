<?php

namespace App\Mail;

use App\Solution;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\DomPDF\Facade as PDF;

class AdminOrderRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $solution = (new Solution)->findOrFail($this->request['object']);

        return $this
            ->from(env('MAIL_NOREPLY'), 'Leaseofferte.com')
            ->replyTo($this->request['email'], $this->request['voornaam'])
            ->subject('Lease aanvraag: ' . $this->request['bedrijfsnaam'] . " | " . $solution->title)
            ->view('mails.order-admin');
    }
}
