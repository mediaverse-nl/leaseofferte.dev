
setInterval(keepTokenAlive, 1000 * 60 * 1); // every 15 mins

function keepTokenAlive() {
    $.ajax({
        url: '/refresh-csrf',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).then(function (res) {
        $('meta[name="csrf-token"]').attr('content', res);
    });
}

calculation();

function calculation()
{
    var aanschaf = parseFloat($("#aanschaf").val());
    var aanbetaling = parseFloat($("#aanbetaling").val());
    var slottermijn = parseFloat($("#slottermijn").val());
    var looptijd = parseFloat($("#looptijd").val().substr(0, 2));
    var obj = $('#object option:selected').val();

    if(!$("#aanbetaling").val()){
        aanbetaling = 0;
    }
    if(!$("#slottermijn").val()){
        slottermijn = 0;
    }

    var total = (aanschaf - aanbetaling - slottermijn);

    // if((total || total === 0)
    //     && (obj || obj === 0)
    //     && (looptijd || looptijd === 0)) {
        $.ajax({
            url: "/api/calculator-rates-"+obj
                +"?aanschaf="+aanschaf
                +"&aanbetaling="+aanbetaling
                +"&slottermijn="+slottermijn
                +"&looptijd="+looptijd,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $(".leasePrice").html("&euro; " + res['leasePrice']);
            }
        });
    // }
}

$('.form-control').on('change keyup paste', function () {
    calculation();
});

$(".moneyFormat").inputmask({
    radixPoint:",",
    // mask: "99999999",
    clearMaskOnLostFocus: "false",
    autoUnmask:true,
    unmaskAsNumber:true,
    alias:"currency",
    // groupSeparator:".",
    // autoGroup:true,
    // digits:2,
    // integerDigits: 8,
    prefix:"\u20ac ",
    rightAlign:false,
    removeMaskOnSubmit:true,
    clearIncomplete: true
});

$('.scrollTo').click(function() {
    var sectionTo = $(this).attr('href');
    $('html, body').animate({
        scrollTop: $(sectionTo).offset().top
    }, 1500);
});


