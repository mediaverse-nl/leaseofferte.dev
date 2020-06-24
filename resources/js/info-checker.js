function getForm($this){
    var Obj = $($this);
    var ObjId = Obj.attr('id');
    if(ObjId == 'object'){
        var ObjValue = $('#object option:selected').text()
        if(ObjValue == '--- object * ---'){
            var ObjValue = null;
        }
    }else if(ObjId == 'aanbetaling' || ObjId == 'slottermijn' || ObjId == 'aanschaf'){
        var ObjValue = new Intl.NumberFormat('nl-NL', { style: 'currency', currency: 'EUR' }).format(Obj.val());
    }else if(ObjId == 'kilometerstand'){
        var ObjValue = new Intl.NumberFormat('nl-NL', { maximumSignificantDigits: 6 }).format(Obj.val());
    }else{
         var ObjValue = Obj.val();
    }
    if (ObjValue == "€ NaN" && (['aanschaf', 'aanbetaling', 'slottermijn'].includes(ObjId))){
        ObjValue = '€ 0.00';
    }
    $('td#'+ObjId).html(ObjValue);
    $('h2#'+ObjId).html(ObjValue);
}

$('.leaseAccordion .form-control').each(function(){
    getForm(this);
});

$(' input, select').on('change keyup paste', function () {
    getForm(this);
});
