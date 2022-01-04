jQuery(document).ready(function($) {
	$('#ip2location-country-blocker-notice').click(function(e) {
		e.preventDefault();
		$.post(ajaxurl, { action: 'ip2location_country_blocker_dismiss_notice' });
	});
});