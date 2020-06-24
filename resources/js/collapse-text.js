$('#less').toggleClass("show").toggleClass("d-none");

moreLessText();
$("#more, #less").click(function() {
    moreLessText();
    topFunction();
});

function topFunction() {
    var docHeight = $( document ).height();
    var btnHeight = $("#more").offset().top;

    if(btnHeight != 0){
        document.body.scrollTop = docHeight -  btnHeight;
        document.documentElement.scrollTop = docHeight -  btnHeight;
    }
}

function moreLessText() {
    $("#thediv").toggleClass("reveal-closed").toggleClass("reveal-open");
    $('#more, #less').toggleClass("show").toggleClass("d-none");
}

setTimeout(function () {
    var height = $('#textContainer').height();
    if(height <= 500){
        moreLessText();
        $("#more, #less").remove();
        $(".fadeout").remove();
    }
}, 100);
