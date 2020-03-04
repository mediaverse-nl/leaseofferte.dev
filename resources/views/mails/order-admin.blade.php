@php
    $categoryChecker = new \App\Category();

    $object_id = (int)$request['object'];
    $aanschaf = $request['aanschaf'];
    $aanbetaling = $request['aanbetaling'];
    $slottermijn = $request['slottermijn'];
    $looptijd = is_int($request['looptijd']) ? $request['looptijd'] : (int)str_replace(" maanden", "", $request['looptijd']);

    $objectName = \App\Solution::find($object_id);;

    $tableFields = $categoryChecker->whereHas('solutions', function ($q) use ($object_id){
        $q->where('id', '=', $object_id);
    })->first();

    $tableFieldsOne = $tableFields->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'ASC')->get();
    $tableFieldsTwo = $tableFields->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get();

@endphp



{{--<table>--}}
{{--    @foreach($request as $k => $v)--}}
{{--        <tr>--}}
{{--            <td>{!! str_replace('_', ' ', $k) !!} </td>--}}
{{--            <td> {!! $v !!}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}

<table class="table table-borderless table-sm">
    <tbody>
        <tr>
            <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
                <b>Lease bedrag</b>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">leasebedrag p.m. </td>
            <td>€ {!! getLeasePrice($object_id, $aanschaf, $looptijd, $slottermijn, $aanbetaling) !!} </td>
        </tr>
{{--        <tr>--}}
{{--            <td style="width: 50%;">Rentepercentage </td>--}}
{{--            <td>{!! $objectName->getFinancialRate($aanschaf - $aanbetaling) !!}%</td>--}}
{{--        </tr>--}}
        <tr>
            <td style="width: 50%;">Locatie </td>
            <td>loc{!! str_replace('.', '', $objectName->getFinancialRate($aanschaf - $aanbetaling) ) !!}</td>
        </tr>
    </tbody>
</table>
<table class="table table-borderless table-sm">
    <tbody>
    <tr>
        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
            <b>Leasecondities</b>
        </td>
    </tr>
    <tr>
        <td style="width: 50%;">Aanschaf excl. BTW </td>
        <td id="aanschaf" style="">€ {!! number_format($aanschaf, 2, ',', '.') !!} </td>
    </tr>

    <tr>
        <td style="width: 50%;">Aanbetaling</td>
        <td id="aanbetaling" style="">€&nbsp;{!! number_format($aanbetaling, 2, ',', '.')  !!}</td>
    </tr>
    <tr>
        <td style="width: 50%;">Te financieren </td>
        <td id="aanschaf" style="font-weight: bold">€ {!! number_format($aanschaf - $aanbetaling, 2, ',', '.') !!} </td>
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
        <td style="width: 50%;">Object</td>
        <td id="object">{!! $objectName->title !!}</td>
    </tr>
    </tbody>
</table>
<table class="table table-borderless table-sm" id="leaseForm" style=" ">
    <tbody>
    <tr>
        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
            <b>Leaseobject</b>
        </td>
    </tr>
    @foreach($tableFieldsOne as $f)
        <tr>
            <td style="width: 50%;">{!! ucfirst($f->field_name) !!}</td>
            <td style="">
                {!! isset($request[StripReplace($f->field_name)]) ? $request[StripReplace($f->field_name)] : '' !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-borderless table-sm" id="leaseForm" style=" ">
    <tbody>
    <tr>
        <td colspan="2" style="color: #006A8E; background: #F0F6F9 !important;">
            <b>Klant gegevens</b>
        </td>
    </tr>
    @foreach($tableFieldsTwo as $f)
        <tr>
            <td style="width: 50%;">{!! ucfirst($f->field_name) !!}</td>
            <td id="type_uitvoering" style="">
                {!! isset($request[StripReplace($f->field_name)]) ? $request[StripReplace($f->field_name)] : '' !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
