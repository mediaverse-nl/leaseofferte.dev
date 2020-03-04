@if(session()->exists('orderStatus'))
    <div class="modal fade in" id="lastNoteModel" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fas fa-times" style="color: #006A8E; font-size: 20px;"></i>
                    </button>

                    <span class="h3" style="color: #006A81; font-weight: bold">
                         <i class="fas fa-thumbs-up" style="color: #006A8E; font-size: 30px;"></i>
                            Uw <span style="color: #009FD6">lease offerte</span> zit in uw <span style="color: #009FD6">e-mailbox
                        </span>
                    </span>
                    <br>
                    <br>

                    <span class="h3" style="color: #006A81; font-weight: bold">Gelieve de gevraagde gegevens aan te leveren.</span> <br>
                    {{--                                <hr>--}}
                    <span style="color: #6c757d;">
                        <br>
                        <b>Beoordeling binnen 48 uur na aanlevering gegevens</b> <br><br>
                        Uw aanvraag wordt direct na ontvangst van bovenstaande gegevens beoordeeld.
                        <br>
                        Bij akkoord ontvangt u direct uw definitieve leaseofferte. <br><br>

                        <span class="h5" style="font-weight: bold">Direct contact met een van onze lease specialisten</span>
                        <br>
                        <br>
                        ☎ (030) 227 16 19
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif

@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript">
        // $(window).on('load',function(){
            $('#lastNoteModel')
                .modal('show')
        // });
    </script>
@endpush
