@php
    $categoryChecker = new \App\Category();

    $object_id = (int)$data['object'];
    $aanschaf = $data['aanschaf'];
    $aanbetaling = $data['aanbetaling'];
    $slottermijn = $data['slottermijn'];
    $looptijd = is_int($data['looptijd']) ? $data['looptijd'] : (int)str_replace(" maanden", "", $data['looptijd']);

    $objectName = \App\Solution::find($object_id);

    $tableFields = $categoryChecker->whereHas('solutions', function ($q) use ($object_id){
        $q->where('id', '=', $object_id);
    })->first();

    $tableFieldsOne = $tableFields->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'ASC')->get();
    $tableFieldsTwo = $tableFields->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get();

@endphp

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>leaseofferte.com</title>
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
            <span style="font-size: 24px; color: #009FD6 !important"> {!! $objectName->title !!}</span>
            <br>
            Uw Leasebedrag per maand <b style="color:#7FAF1B;">€ {!! getLeasePrice($object_id, $aanschaf, $looptijd, $slottermijn, $aanbetaling) !!}
            </b><br>
        </p>
        <div class="card-body">
            <table class="table table-borderless table-sm">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Uw leasecondities</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Aanschaf excl. BTW </td>
                        <td id="aanschaf">€ {!! number_format($aanschaf, 2, ',', '.') !!} </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Aanbetaling</td>
                        <td id="aanbetaling">€&nbsp;{!! number_format($aanbetaling, 2, ',', '.')  !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Slottermijn</td>
                        <td id="slottermijn">€&nbsp;{!! number_format($slottermijn, 2, ',', '.')  !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Looptijd</td>
                        <td id="looptijd">{!! $looptijd !!} maanden</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Category</td>
                        <td id="object">{!! $objectName->category->value !!}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-borderless table-sm" id="leaseForm" style=" ">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Uw leaseobject</b>
                        </td>
                    </tr>
                    @foreach($tableFieldsOne as $f)
                        <tr>
                            <td style="width: 50%;">{!! ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name) !!}</td>
                            <td style="">
                                {!! isset($data[StripReplace($f->field_name)]) ? $data[StripReplace($f->field_name)] : '' !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-borderless table-sm" id="leaseForm" style=" ">
                <tbody>
                    <tr>
                        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                            <b>Uw gegevens</b>
                        </td>
                    </tr>
                    @foreach($tableFieldsTwo as $f)
                        <tr>
                            <td style="width: 50%;">{!! ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name) !!}</td>
                            <td id="type_uitvoering" style="">
                                {!! isset($data[StripReplace($f->field_name)]) ? $data[StripReplace($f->field_name)] : '' !!}
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
