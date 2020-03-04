<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OperationalOrderRequest extends Mailable
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
        $pdf = PDF::loadView('pdf.order-operational', [
            'data' => $this->request,
        ]);

        $mail = $this
            ->from(env('MAIL_NOREPLY'), 'Leaseofferte.com')
            ->replyTo($this->request['email'], $this->request['voornaam_en_achternaam'])
            ->subject('Operational lease aanvraag')
            ->attachData($pdf->output(), "operational-lease-aanvraag.pdf")
            ->view('mails.order-operational');

        if (isset($this->request['bestanden'])){
            foreach($this->request['bestanden'] as $filePath){
                $mail->attach($filePath->getRealPath(), array(
                        'as' => 'resume.' . $filePath->getClientOriginalExtension(),
                        'mime' => $filePath->getMimeType())
                );
            }
        }

        return $mail;
    }
}
