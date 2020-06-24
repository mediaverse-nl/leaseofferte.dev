@php
    $leaseObject = collect($data)
        ->only([
            'jaarkilometrage',
            'looptijd',
            'winterbanden',
            'vervangend_vervoer',
        ])
        ->toArray();

    $leaseGegevens = collect($data)
        ->only([
            'voornaam_en_achternaam',
            'bedrijfsnaam',
            'kvk_nummer',
            'adres',
            'postcode',
            'plaats',
            'email',
            'telefoonnummer',
        ])
        ->toArray();

    $leaseOffer = \App\LeaseOffer::find($data['operational_id']);
    $leaseOffer = collect($leaseOffer)->except(['description']);


    $leaseSpecs = collect($leaseOffer)->only([
        'title',
        'uitvoering',
        'merk',
        'type',
        'auto_segment',
        'brandstof',
        'carrosserie',
        'aantal_deuren',
    ]);
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>leaseofferte.nl</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        * {
            font-family: "Roboto Light", sans-serif;
         }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
<div class="">

    <table class="table" cellpadding="0" cellspacing="0">
        <tr style="width: 100%;">
            <td class="text-center" style="width: 100%; border: none !important;">
                <img src="https://leaseofferte.com/img/leaseofferte-logo.png" style="width:270px; ">
            </td>
        </tr>
    </table>

    <div class="">
        <div class="col-md-6" style="display: inline-block; width: 50% !important;">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <b>Leaseofferte.com</b> <br>
                        Hoofdveste 32b,<br>
                        3992 DG Houten,<br>
                        Nederland<br>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6" style="display: inline-block; width: 50% !important;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: right">
                        <b>Site: <br>
                            Tel: <br>
                            E-mail: <br>
                            BTW: <br>KvK:</b>
                    </td>
                    <td style="text-align: left">
                        www.leaseofferte.com <br>
                        +31 30 227 16 19<br>
                        info@leaseofferte.com<br>
                        NL8173.47.811B01<br>
                        30220695
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style="margin-top: -80px;">
        <p class="text-center" style="font-weight: bold; font-size: 32px; font-family: 'Roboto Light', sans-serif; padding-bottom: 0px !important; color: #006A8E;">
            Uw lease aanvraag voor <br> <b style="color:#7FAF1B;">{!! $leaseOffer['merk'] . ' ' .  $leaseOffer['type']  . ' ' . $leaseOffer['uitvoering'] !!}</b><br>
        </p>
        <div class="card-body">
            <table class="table table-borderless table-sm" id="leaseForm" style=" ">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Auto specificaties</b>
                        </td>
                    </tr>
                    @foreach($leaseSpecs as $k => $v)
                        @if($k !== 'title')
                            <tr>
                                <td style="width: 50%;">
                                    @if($k == 'title')
                                        {!! ucfirst(str_replace('_', ' ', 'auto'))!!}
                                    @else
                                        {!! ucfirst(str_replace('_', ' ', $k)) !!}
                                    @endif
                                </td>
                                <td style="">
                                    {!! $v !!}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <table class="table table-borderless table-sm" id="leaseForm" style=" ">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Uw leaseobject</b>
                        </td>
                    </tr>
                    @foreach($leaseObject as $k => $v)
                        <tr>
                            <td style="width: 50%;">
                                @if($k == 'winterbanden')
                                    {!! $k == 'winterbanden' ? ucfirst(str_replace('_', ' ', 'met '.$k)) :  ucfirst(str_replace('_', ' ', $k))!!}
                                @elseif($k == 'vervangend_vervoer')
                                    {!! ucfirst(str_replace('_', ' ', $k.' na 24 uur'))!!}
                                @elseif($k == 'email')
                                    {!! ucfirst('E-mail')!!}
                                @else
                                    {!! ucfirst(str_replace('_', ' ', $k)) !!}
                                @endif
                            </td>
                            <td style="">
                                {!! $v !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="page-break"></div>
            <table class="table table-borderless table-sm" id="leaseForm" style=" ">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Uw gegevens</b>
                        </td>
                    </tr>
                    @foreach($leaseGegevens as $k => $v)
                        <tr>
                            @if($k == 'email')
                                <td style="width: 50%;"> {!! ucfirst('E-mail')!!}</td>
                            @else
                                <td style="width: 50%;">{!! ucfirst(str_replace('_', ' ', $k)) !!}</td>
                            @endif
                            <td style="">
                                {!! $v !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <small class="text-muted">
        Op onze dienstverlening zijn de algemene voorwaarden van LEASEOFFERTE.com van toepassing, welke zijn gedeponeerd bij de Kamer van Koophandel onder nummer 30220695.
        Dit voorstel betreft een indicatief leasevoorstel.
        <br>
        <br>
        Druk en zetfouten voorbehouden en kunnen geen rechten aan worden ontleend.
    </small>

</div>
</body>
</html>
