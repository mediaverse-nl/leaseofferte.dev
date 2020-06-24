<?php

namespace App\Mail;

use App\LeaseOffer;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminOperationalOrderRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @param array $operationalData
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
        $operation = (new LeaseOffer)->findOrFail($this->request['operational_id']);

        $pdf = PDF::loadView('pdf.order-operational', [
            'data' => $this->request,
        ]);

        $mail = $this
            ->from(env('MAIL_NOREPLY'), 'Leaseofferte.com')
            ->replyTo($this->request['email'], $this->request['voornaam_en_achternaam'])
            ->subject('Operational lease aanvraag: '. $this->request['bedrijfsnaam'] ." | ". $operation->merk." | ". $operation->type)
            ->attachData($pdf->output(), $this->request['bedrijfsnaam']."-operational-lease-aanvraag.pdf")
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
