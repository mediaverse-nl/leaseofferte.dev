/* Thanks to CSS Tricks for pointing out this bit of jQuery
http://css-tricks.com/equal-height-blocks-in-rows/
It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

(function ($) {
		   
	equalheight = function(container){

		var currentTallest = 0,
		currentRowStart = 0,
		rowDivs = new Array(),
		$el,
		topPosition = 0;
		$(container).each(function() {
			$el = $(this);
			$($el).height('auto')
			topPostion = $el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = $el.height();
				rowDivs.push($el);
			} else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}

	
	$(window).load(function() {
		equalheight('.caw-fab-menu .caw-fab-link-cta');
		equalheight('.caw-fab-menu .caw-fab-link-normal');
		if (document.documentElement.clientWidth > 767) {
			equalheight('.caw-vehicle.vehicle-photo-view .vehicle-options');
			equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');
		}
	});
	
	
	$(window).resize(function(){
		equalheight('.caw-fab-menu .caw-fab-link-cta');
		equalheight('.caw-fab-menu .caw-fab-link-normal');
		if (document.documentElement.clientWidth > 767) {
			equalheight('.caw-vehicle.vehicle-photo-view .vehicle-options');
			equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');
		}
	});
	
	/*
	$('.search input').change(function() {
		if (document.documentElement.clientWidth > 767) {
			setTimeout(function() { // Set a small timeout for content time to reload
				equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');
			}, 1000);
		}
	});
	
	$('.vehicle-overview').on('click', '.caw-pagination a', function() {
		if (document.documentElement.clientWidth > 767) {
			setTimeout(function() { // Set a small timeout for content time to reload
				equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');
			}, 1000);
		}
	}); */
	
})(jQuery);