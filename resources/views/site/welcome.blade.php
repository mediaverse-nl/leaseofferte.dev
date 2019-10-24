@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #009FD6 !important; color: #ffffff !important;">
        <div class="container">
            <div class="row" style="padding: 30px 0px 100px 0px;">
                <div class="col-md-6">
                    <h1 class="display-4" style="font-size: 32px;">Lease uw auto's of bedrijfsmiddelen bij LEASEOFFERTE.com</h1>
                    <br>
                    <br>
                    <p class="lead">
                        ✔ Scherpe tarieven ✔ Goede voorwaarde ✔ Persoonlijke service
                        <br>
                        <br>
                        Dien uw aanvraag in en ontvang van ons de beste lease overeenkomst in de markt.
                        <br>
                        <br>
                        {!! Editor('home_banner_paragraaf', 'richtext', false, "") !!}
                    </p>
                    <a href="#calculator" class="scrollTo btn btn-default btn-block" style="border-radius: 4px; padding: 10px; font-size: 18px">Bereken uw lease prijs</a>
                    <br>
                    <br>
                </div>
                <div class="col-md-6">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/k6OpkHFBhIM?loop=1&modestbranding=1" width=560 height=315 frameborder=0 allowfullscreen>
                        </iframe>
                    </div>
                    <br>
                    <br>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="border: none !important; background: #FFFFFF !important; margin-top: -160px !important;">
                    <div class="card-body" style="padding: 30px;">
                        <h2 class="h2" style="color: #006A8E;">Lease Calculator</h2>
                        <div class="row">
                            <div class="col-md-6">

                                <p>Dien bij ons uw aanvraag in, en u weet binnen enkele uren waar deze geaccepteerd wordt, en wat het optimale lease tarief en de optimale voorwaarden zijn.</p>

                                <br>
                                <br>


                                @component('components.lease-calculator')
                                @endcomponent

                            </div>
                            <div class="col-md-6">
                                <h2 class="h2" style="color: #006A8E;">Lease offerte AUTO - financial lease</h2>

                                <div class="card" id="calculator" style="border: none !important; background: #FFFFFF !important;">
                                    <div class="card-body" style="border: 1px solid #D9E9EE;">


                                        <table class="table table-borderless table-sm" id="leaseForm">
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <img src="/img/leaseofferte-logo.png" alt="" class="img-fluid" style="height: 50px;">
                                                    <br>
                                                    <br>
                                                    <h3 class="h3" style="color: #006A8E;">LEASE AANVRAAG</h3>

                                                    <p style="color: #006A8E;">Leasebedrag per maand: <b style="color:#7FAF1B;">€519</b> of lager</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="margin-bottom: 200px !important;"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="color: #006A8E;"><b>Uw leaseobject</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Soort</td>
                                                <td id="soort"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Merk</td>
                                                <td id="merk"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Type</td>
                                                <td id="type"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Kenteken</td>
                                                <td id="kenteken"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Bouwjaar</td>
                                                <td id="bouwjaar"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Leverancier</td>
                                                <td id="leverancier"></td>
                                            </tr>


                                            <tr>
                                                <td style="margin-bottom: 200px !important;"></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="color: #006A8E;"><b>Uw leasecondities</b></td>
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
                                                <td style="margin-bottom: 200px !important;"></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="color: #006A8E;"><b>Uw gegevens</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Bedrijfsnaam</td>
                                                <td id="bedrijfsnaam"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">K.v.k. nummer</td>
                                                <td id="kvk"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">T.a.v</td>
                                                <td id="volledige_naam"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Geboortedatum</td>
                                                <td id="geboortedatum"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">E-mailadres</td>
                                                <td id="email"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">Telefoonnummer</td>
                                                <td id="telefoonnummer"></td>
                                            </tr>
                                        </table>

                                        <a href="" class="btn btn-default btn-block" style="padding: 15px; ">Bereken uw lease</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            $('.leaseAccordion input').on('keyup paste', function () {
                var Obj = $(this);
                var ObjId = Obj.attr('id');
                var ObjValue = Obj.val();

                console.log(Obj, ObjId, ObjValue);

//                $('td#merk').html('changed value');

                $('td#'+ObjId).html(ObjValue);
//                $( ".leaseAccordion input" ).each(function( index ) {
//                    console.log( index + ": " + $( this ).text() );
//                });
            });
        });
    </script>
@endpush
