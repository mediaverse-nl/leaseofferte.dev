/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Favorite
5. Init Fix Product Border
6. Init Isotope Filtering
7. Init Price Slider
8. Init Checkboxes



******************************/

jQuery(document).ready(function($)
{
	"use strict";

	/*

	1. Vars and Inits

	*/

	var header = $('.header');
	var topNav = $('.top_nav')
	var mainSlider = $('.main_slider');
	var hamburger = $('.hamburger_container');
	var menu = $('.hamburger_menu');
	var menuActive = false;
	var hamburgerClose = $('.hamburger_close');
	var fsOverlay = $('.fs_menu_overlay');

	setHeader();

	$(window).on('resize', function()
	{
		initFixProductBorder();
		setHeader();
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	initMenu();
	initFavorite();
	initFixProductBorder();
	initIsotopeFiltering();
	// initPriceSlider();
	// initCheckboxes();

	/*

	2. Set Header

	*/

	function setHeader()
	{
		if(window.innerWidth < 992)
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"0"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		else
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"-50px"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		if(window.innerWidth > 991 && menuActive)
		{
			closeMenu();
		}
	}

	/*

	3. Init Menu

	*/

	function initMenu()
	{
		if(hamburger.length)
		{
			hamburger.on('click', function()
			{
				if(!menuActive)
				{
					openMenu();
				}
			});
		}

		if(fsOverlay.length)
		{
			fsOverlay.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if(hamburgerClose.length)
		{
			hamburgerClose.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if($('.menu_item').length)
		{
			var items = document.getElementsByClassName('menu_item');
			var i;

			for(i = 0; i < items.length; i++)
			{
				if(items[i].classList.contains("has-children"))
				{
					items[i].onclick = function()
					{
						this.classList.toggle("active");
						var panel = this.children[1];
					    if(panel.style.maxHeight)
					    {
					    	panel.style.maxHeight = null;
					    }
					    else
					    {
					    	panel.style.maxHeight = panel.scrollHeight + "px";
					    }
					}
				}
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		// menu.css('right', "0");
		fsOverlay.css('pointer-events', "auto");
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		fsOverlay.css('pointer-events', "none");
		menuActive = false;
	}

	/*

	4. Init Favorite

	*/

    function initFavorite()
    {
    	if($('.favorite').length)
    	{
    		var favs = $('.favorite');

    		favs.each(function()
    		{
    			var fav = $(this);
    			var active = false;
    			if(fav.hasClass('active'))
    			{
    				active = true;
    			}

    			fav.on('click', function()
    			{
    				if(active)
    				{
    					fav.removeClass('active');
    					active = false;
    				}
    				else
    				{
    					fav.addClass('active');
    					active = true;
    				}
    			});
    		});
    	}
    }

    /*

	5. Init Fix Product Border

	*/

    function initFixProductBorder()
    {
    	if($('.product_filter').length)
    	{
			var products = $('.product_filter:visible');
    		var wdth = window.innerWidth;

    		// reset border
    		products.each(function()
    		{
    			$(this).css('border-right', 'solid 1px #e9e9e9');
    		});

    		// if window width is 991px or less

    		if(wdth < 480)
			{
				for(var i = 0; i < products.length; i++)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 576)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 1; i < products.length; i+=2)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 768)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 2; i < products.length; i+=3)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 992)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 2; i < products.length; i+=3)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

			//if window width is larger than 991px
			else
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 3; i < products.length; i+=4)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}
    	}
    }

    /*

	6. Init Isotope Filtering

	*/

    var filters = {};

    function initIsotopeFiltering()
    {
    	var sortTypes = $('.type_sorting_btn');
    	var sortNums = $('.num_sorting_btn');
    	var sortTypesSelected = $('.sorting_type .item_sorting_btn is-checked span');
    	var filterButton = $('.filter_button');

    	if($('.product-grid').length)
    	{

    		$('.product-grid').isotope({
    			itemSelector: '.product-item',
	            getSortData: {
	            	price: function(itemElement)
	            	{
	            		var priceEle = $(itemElement).find('.product_price').text().replace( '€', '' );
	            		return parseFloat(priceEle);
	            	},
	            	name: '.product_name'
	            },
	            animationOptions: {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	        });

    		// Short based on the value from the sorting_type dropdown
	        sortTypes.each(function()
	        {
	        	$(this).on('click', function()
	        	{
	        		$('.type_sorting_text').text($(this).text());
	        		var option = $(this).attr('data-isotope-option');
	        		option = JSON.parse( option );
    				$('.product-grid').isotope( option );
	        	});
	        });

	        // Show only a selected number of items
	        sortNums.each(function()
	        {
	        	$(this).on('click', function()
	        	{
	        		var numSortingText = $(this).text();
					var numFilter = ':nth-child(-n+' + numSortingText + ')';
	        		$('.num_sorting_text').text($(this).text());
    				$('.product-grid').isotope({filter: numFilter });
	        	});
	        });

	        // Filter based on the price range slider
	        filterButton.on('click', function()
	        {
	        	$('.product-grid').isotope({
                    filter: function()
                    {
                        var priceRange = $('#amount').val();
                        var priceMin = parseFloat(priceRange.split('-')[0].replace('$', ''));
                        var priceMax = parseFloat(priceRange.split('-')[1].replace('$', ''));
                        var itemPrice = $(this).find('.product_price').clone().children().remove().end().text().replace( '€', '' );

                        // console.log();

                        var yourArray = [];
                        $("#detail:checked").each(function(){
                            yourArray.push($(this).val());
                        });

                        console.log(yourArray);

                        // var propertiesRange = $('#detai
                        //
                        // console.log(propertiesRange);
                        //
                        // var productProperties = $(this).find('.product_properties').clone().children().remove().end().text().split(",").map(i=>i.trim());
                        //
                        // console.log(productProperties);

                        return (itemPrice > priceMin) && (itemPrice < priceMax);
                    },
		            animationOptions: {
		                duration: 750,
		                easing: 'linear',
		                queue: false
		            }
		        });

            });
    	}
    }

    /*

	7. Init Price Slider

	*/

    // function initPriceSlider()
    // {
		// $( "#slider-range" ).slider(
		// {
		// 	range: true,
		// 	min: 0,
		// 	max: 1000,
		// 	// values: [ 0, 580 ],
		// 	slide: function( event, ui )
		// 	{
		// 		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		// 	}
		// });
		//
		// $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    // }

    /*

	8. Init Checkboxes

	*/



    // do stuff when checkbox change
    $('.sidebar').on('change', function( jQEvent ) {

    	console.log($( jQEvent.target ));

        var $checkbox = $( jQEvent.target );

        manageCheckbox( $checkbox );

        var comboFilter = getComboFilter( filters );

        $('.product-grid').isotope({ filter: comboFilter });

        $('.product-grid').isotope( 'on', 'layoutComplete', function( isoInstance, laidOutItems ) {
            updateCount();
        });

    });

    $.expr[':'].hasClassStartingWith = function(el, i, selector) {
        var re = new RegExp("\\b" + selector[3]);
        return re.test(el.className);
    }

    function updateCount() {
        var numItems = 0;
        $('.count').each(function( index ) {
            if ( $(this).prev('input').hasClass('all') ) {
                numItems = $('.product-item').length;
                $(this).html(numItems);
            }
            else {
                // var itemClass = $(this).prev('input').val().substring(1);
                // var itemSelector = ".product-grid div:hasClassStartingWith('" + itemClass + "')";
                // numItems = $(itemSelector).not(":hidden").length;
                // $(this).html(numItems);
            }
        });
    }

    function getComboFilter( filters ) {
        var i = 0;
        var comboFilters = [];
        var message = [];

        for ( var prop in filters ) {
            message.push( filters[ prop ].join(' ') );
            var filterGroup = filters[ prop ];
            // skip to next filter group if it doesn't have any values
            if ( !filterGroup.length ) {
                continue;
            }
            if ( i === 0 ) {
                // copy to new array
                comboFilters = filterGroup.slice(0);
            } else {
                var filterSelectors = [];
                // copy to fresh array
                var groupCombo = comboFilters.slice(0); // [ A, B ]
                // merge filter Groups
                for (var k=0, len3 = filterGroup.length; k < len3; k++) {
                    for (var j=0, len2 = groupCombo.length; j < len2; j++) {
                        filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
                    }

                }
                // apply filter selectors to combo filters for next group
                comboFilters = filterSelectors;
            }
            i++;
        }

        var comboFilter = comboFilters.join(', ');
        return comboFilter;
    }

    function manageCheckbox( $checkbox ) {
        var checkbox = $checkbox[0];

        var group = $checkbox.parents('fieldset').attr('data-group');
        // create array for filter group, if not there yet

		console.log(group);
        var filterGroup = filters[ group ];
        if ( !filterGroup ) {
            filterGroup = filters[ group ] = [];
        }

        var isAll = $checkbox.hasClass('all');
        // reset filter group if the all box was checked
        if ( isAll ) {
            delete filters[ group ];
            if ( !checkbox.checked ) {
                checkbox.checked = 'checked';
            }
        }
        // index of
        var index = $.inArray( checkbox.value, filterGroup );

        if ( checkbox.checked ) {
            var selector = isAll ? 'input' : 'input.all';
            $checkbox.siblings( selector ).removeAttr('checked');

            if ( !isAll && index === -1 ) {
                // add filter to group
                filters[ group ].push( checkbox.value );
            }

        } else if ( !isAll ) {
            // remove filter from group
            filters[ group ].splice( index, 1 );
            // if unchecked the last box, check the all
            if ( !$checkbox.siblings('[checked]').length ) {
                $checkbox.siblings('input.all').attr('checked', 'checked');
            }
        }

    }

    updateCount();
});