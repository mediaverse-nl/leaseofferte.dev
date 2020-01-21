var jq = jQuery.noConflict();

jq(function() {

	setResponsiveStep();

	// Set responsive size and search width for affix on resize
	jq(window).resize(function() {
		setResponsiveStep();
		equalheight('.caw-vehicle.vehicle-photo-view .vehicle-options');
		equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');
	});

	// Responsive functions
	function setResponsiveStep() {
		// get the container width and add 30 to it to compensate negative margins of bootstrap
		var width = (jq('#caw-container').width() + 30);

		// Define the bootstrap steps
		var xs = 480;
		var sm = 600;
		var md = 790;
		var lg = 1200;

		// XS layout
		if(width < sm) {
			jq('.caw-ui').addClass('caw-ui-xs');
			jq('.caw-ui').removeClass('caw-ui-sm');
			jq('.caw-ui').removeClass('caw-ui-md');
			jq('.caw-ui').removeClass('caw-ui-lg');
		// SM layout
		} else if(width < md) {
			jq('.caw-ui').addClass('caw-ui-sm');
			jq('.caw-ui').removeClass('caw-ui-xs');
			jq('.caw-ui').removeClass('caw-ui-md');
			jq('.caw-ui').removeClass('caw-ui-lg');
		// MD layout
		} else if(width < lg) {
			jq('.caw-ui').addClass('caw-ui-md');
			jq('.caw-ui').removeClass('caw-ui-xs');
			jq('.caw-ui').removeClass('caw-ui-sm');
			jq('.caw-ui').removeClass('caw-ui-lg');
		// LG layout
		} else {
			jq('.caw-ui').addClass('caw-ui-lg');
			jq('.caw-ui').removeClass('caw-ui-xs');
			jq('.caw-ui').removeClass('caw-ui-sm');
			jq('.caw-ui').removeClass('caw-ui-md');
		}
	}

	equalheight('.caw-vehicle.vehicle-photo-view .vehicle-options');
	equalheight('.caw-vehicle.vehicle-photo-view .vehicle-extra');

	jq("article.caw-vehicle").click( function() {
		document.cookie = "caw4_overview_url=" + overviewUrl + " ; path=/";
		window.location= jq(this).find("a.vehicle-link").attr("href");
	});
})
