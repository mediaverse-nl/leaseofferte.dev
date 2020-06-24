@php
    $categoryChecker = new \App\Category();

    $formObj = !empty(session('formFields')) ? (object)decrypt(session('formFields')) : (object)[];

    if (isset($formObj->object)){
        $object_id = $formObj->object;
        $tableFields = $categoryChecker
            ->with(['solutions', 'dynamicFields'])
            ->whereHas('solutions', function ($q) use ($object_id){
                $q->where('id', '=', $object_id);
            })->first();
    }else{
        $tableFields = $categoryChecker
            ->with(['solutions', 'dynamicFields'])
            ->first();
    }

    $tableFieldsOne = $tableFields->dynamicFields()->where('form_part', '=', 2)->orderBy('field_order', 'ASC')->get();
    $tableFieldsTwo = $tableFields->dynamicFields()->where('form_part', '=', 3)->orderBy('field_order', 'ASC')->get();
@endphp

<div class="card" id="calculator" style="border: 1px solid rgba(0, 0, 0, 0.125); background: #FFFFFF !important; ">
    <div class="card-header" style="clear: both; max-height:250px; border: 0px; border-bottom: 1px solid rgba(0, 0, 0, 0.125); background: #F0F6F9 !important;">
        <p class="h3 text-center" style="padding-bottom: 0px !important; padding: 0.5rem; color: #006A8E;">Uw Leasebedrag per maand <span style="white-space: nowrap"><b style="color:#7FAF1B;" id="leasePrice" class="leasePrice">&euro; 0</b></span></h2>
    </div>
    <div class="card-body" style="">
        <h2 id="object" class="text-center" style="color: #6c757d;"></h2>

         <table class="table table-borderless table-sm" id="leaseForm" style="table-layout: fixed;">
            <tr>
                <td colspan="2" style="color: #006A8E;">
                    <b>Uw leasecondities</b> (stap 1)
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">Aanschaf excl. BTW </td>
                <td id="aanschaf"></td>
            </tr>
            <tr>
                <td style="width: 50%;">Aanbetaling</td>
                <td id="aanbetaling"></td>
            </tr>
            <tr>
                <td style="width: 50%;">Slottermijn</td>
                <td id="slottermijn"></td>
            </tr>
            <tr>
                <td style="width: 50%;">Looptijd</td>
                <td id="looptijd"></td>
            </tr>
            <tr>
                <td style="width: 50%;">Object</td>
                <td id="object"></td>
            </tr>
            <tr>
                <td style="margin-bottom: 200px !important;"></td>
            </tr>
            <tr>
                <td colspan="2" style="color: #006A8E;">
{{--                    @if(isset($edit) && $edit == true)--}}
                    <span class="">
                        <a class="btn btn-block btn-orange btn-sm btn-block" onClick='submitForm(1)' style="color: white;">
                            <i class="fas fa-edit"></i>
                            wijzig stap 1
                        </a>
                    </span>
{{--                    @endif--}}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="color: #006A8E;">
                    <b>Uw leaseobject</b> (stap 2)
                </td>
            </tr>

            @foreach($tableFieldsOne as $f)
                <tr>
                    <td style="width: 50%;">{!! ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name) !!}</td>
                    <td id="{!! StripReplace($f->field_name) !!}" style=""></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="color: #006A8E;">
                    @if(isset($tableFieldsOne) && $tableFieldsOne->count() >= 1)
                    <span class="">
                        <a class="btn btn-block btn-orange btn-sm btn-block" onClick='submitForm(2)' style="color: white;">
                           <i class="fas fa-edit"></i> wijzig stap 2
                        </a>
                    </span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="margin-bottom: 200px !important;"></td>
            </tr>

            <tr>
                <td colspan="2" style="color: #006A8E;">
                    <b>Uw gegevens</b> (stap 3)
                </td>
            </tr>

            @foreach($tableFieldsTwo as $f)
                <tr>
                    <td style="width: 50%;">{!! ucfirst($f->field_name == 'email' ? 'E-mail' : $f->field_name) !!}</td>
                    <td id="{!! StripReplace($f->field_name) !!}"></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="color: #006A8E;">
                    @if(isset($tableFieldsTwo) && $tableFieldsTwo->count() >= 1)
                        <span class="">
                            <a class="btn btn-block btn-orange btn-sm btn-block" onClick='submitForm(3)' style="color: white;">
                                <i class="fas fa-edit"></i> wijzig stap 3
                            </a>
                        </span>
                    @endif
                </td>
            </tr>
        </table>

    </div>
</div>

@push('js')
    <script src="/js/info-checker.js" language="javascript" type="text/javascript"></script>
@endpush
