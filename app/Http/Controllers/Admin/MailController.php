<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminOperationalOrderRequest;
use App\Mail\AdminOrderRequest;
use App\Mail\ContactRequest;
use App\Mail\OperationalOrderRequest;
use App\Mail\OrderRequest;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public $data = [
        "object" => "24",
        "aanschaf" => "350000",
        "aanbetaling" => "0",
        "slottermijn" => "0",
        "looptijd" => "60 maanden",
        "type_uitvoering" => "awdawdad",
        "kenteken_indien_bekend" => "sddadasd",
        "kilometerstand" => "34234",
        "bouwjaar" => "3423",
        "website_url_link" => null,
        "merk" => "test",
        "model" => "test",
        "urenstand_indien_van_toepassing" => null,
        "telefoon_mobiel" => "+31653779761",
        "geboortedatum" => "09021993",
        "telefoon_vast" => "+31653779761",
        "email" => "deveron.reniers@gmail.com",
        "voorletter_s" => "d",
        "voornaam" => "d",
        "achternaam" => "reniers",
        "k_v_k_nummer" => "06060280",
        "bedrijfsnaam" => "mediaverse"
    ];

    public $contactData = [
        'naam' => 'deveron',
        'bedrijfnaam' => 'mediaverse',
        'telefoonnummer' => '065522336655',
        'email' => 'test@domein.nl',
        'bericht' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,',
    ];

    public $operationalData = [
        "operational_id" => "1",
        "jaarkilometrage" => "20000",
        "looptijd" => "12 maanden",
        "winterbanden" => "ja",
        "vervangend_vervoer" => "nee",
        "voornaam_en_achternaam" => "deveron reniers",
        "bedrijfsnaam" => "mediaverse",
        "kvk_nummer" => "06600606",
        "adres" => "Daalakkersweg, 2.102",
        "postcode" => "5641JA",
        "plaats" => "EINDHOVEN",
        "email" => "deveron.reniers@gmail.com",
        "telefoonnummer" => "+31653779761",
    ];

    public function contact()
    {
        return new ContactRequest($this->contactData);
    }

    public function operational()
    {
        return new OperationalOrderRequest($this->operationalData);
    }

    public function operationalPdf()
    {
        $pdf = \Barryvdh\DomPDF\Facade::loadView('pdf.order-operational', [
            'data' => $this->operationalData,
        ]);

        return $pdf->stream();
    }

    public function offerte()
    {
        return new OrderRequest($this->data);
    }

    public function offertePdf()
    {
        $pdf = \Barryvdh\DomPDF\Facade::loadView('pdf.order', [
            'data' => $this->data,
        ]);

        return $pdf->stream();
    }
}
