$(document).ready(function(){

    function priceRange(value){
        var val = value.split(",");
        var minPrice = val[0];
        var maxPrice = val[1];
        $("#maxPrice").html(maxPrice);
        $("#minPrice").html(minPrice);
    }
    priceRange($('#priceRange').val());

    $('#priceRange').bind('change', function() {
        priceRange($('#priceRange').val());
    });

    var timer;
    function intervalTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(function() {
            clearInterval(timer);
            submitForm();
        }, 1500);
    }
    function submitForm(){
        $( "#filterForm" ).submit();
    }
    $('#datetimepicker1').change(function() {
        intervalTimer();
    });

    $('#filterForm').change(function() {
        intervalTimer();
    });

    var allRadios = document.getElementById('fuel');
    var booRadio;
    var x = 0;
    for(x = 0; x < allRadios.length; x++){
        allRadios[x].onclick = function() {
            if(booRadio == this){
                this.checked = false;
                booRadio = null;
            } else {
                booRadio = this;
            }
        };
    }
    // store filter for each group
    var buttonFilters = {};
    var buttonFilter;
    // quick search regex
    var qsRegex;

    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows',
        animationOptions: {
            duration: 750,
            easing: 'easein',
            queue: true
        },
        getSortData: {
            name: '.name',
            symbol: '.symbol',
            number: '.number parseInt',
            category: '[data-category]',
            weight: function( itemElem ) {
                var weight = $( itemElem ).find('.weight').text();
                return parseFloat( weight.replace( /[\(\)]/g, '') );
            }
        },
        filter: function() {
            var $this = $(this);
            var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
            var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
            return searchResult && buttonResult;
        }
    });

    // bind filter on radio button click
    $('#filters').on('click', 'input', function() {
        // get filter value from input value
        var $this = $(this);
        var $buttonGroup = $this.parents('.button-group');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        buttonFilters[ filterGroup ] = this.value;
        // combine filters
        buttonFilter = concatValues( buttonFilters );
        // Isotope arrange
        $grid.isotope();
    });

    // change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
        });
    });

    // debounce so filtering doesn't happen every millisecond
    function debounce( fn, threshold ) {
        var timeout;
        threshold = threshold || 100;
        return function debounced() {
            clearTimeout( timeout );
            var args = arguments;
            var _this = this;
            function delayed() {
                fn.apply( _this, args );
            }
            timeout = setTimeout( delayed, threshold );
        };
    }

    // flatten object by concatting values
    function concatValues( obj ) {
        var value = '';
        for ( var prop in obj ) {
            value += obj[ prop ];
        }
        return value;
    }

    if($('.checkboxes li').length)
    {
        var boxes = $('.checkboxes li');

        boxes.each(function()
        {
            var box = $(this);

            box.on('click', function()
            {
                if(box.hasClass('active'))
                {
                    box.find('i').removeClass('fa-square');
                    box.find('i').addClass('fa-square-o');
                    box.toggleClass('active');
                }
                else
                {
                    box.find('i').removeClass('fa-square-o');
                    box.find('i').addClass('fa-square');
                    box.toggleClass('active');
                }
                // box.toggleClass('active');
            });
        });

        if($('.show_more').length)
        {
            $('.show_more').on('click', function(e)
            {
                var checkboxes = $('.checkboxes#'+this.getAttribute('data-id'));
                var checkboxesActive = $('.checkboxes.active#'+this.getAttribute('data-id'));

                var contentName = $(this);

                if(checkboxesActive.length >= 1){
                    contentName.html('<b><span>+</span> laat meer zien</b>')
                }else {
                    contentName.html('<b><span>-</span> laat minder zien</b>')
                }

                checkboxes.toggleClass('active');
            });
        }
    };
});
