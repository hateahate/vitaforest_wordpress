jQuery(document).ready(function($){
	var regex = /^((?!0)(?!.*\.$)((1?\d?\d|25[0-5]|2[0-4]\d|\*)(\.|$)){4})|(([0-9a-f]|:){1,4}(:([0-9a-f]{0,4})*){1,7})$/;

	$('#frontend_ip_blacklist').tagsInput({
		defaultText: '',
		delimiter: ';',
		width: '400px',
		pattern: regex,
		onChange: function(obj, tag){
			if($('#frontend_ip_whitelist').tagExist(tag)){
				$('#frontend_ip_blacklist').removeTag(tag);
			}
		}
	});

	$('#frontend_ip_whitelist').tagsInput({
		defaultText: '',
		delimiter: ';',
		width: '400px',
		pattern: regex,
		onChange: function(obj, tag){
			if($('#frontend_ip_blacklist').tagExist(tag)){
				$('#frontend_ip_whitelist').removeTag(tag);
			}
		}
	});

	$('#backend_ip_blacklist').tagsInput({
		defaultText: '',
		delimiter: ';',
		width: '400px',
		pattern: regex,
		onChange: function(obj, tag){
			if($('#backend_ip_whitelist').tagExist(tag)){
				$('#backend_ip_blacklist').removeTag(tag);
			}
		}
	});

	$('#backend_ip_whitelist').tagsInput({
		defaultText: '',
		delimiter: ';',
		width: '400px',
		pattern: regex,
		onChange: function(obj, tag){
			if($('#backend_ip_blacklist').tagExist(tag)){
				$('#backend_ip_whitelist').removeTag(tag);
			}
		}
	});

	refresh_frontend_settings();
	refresh_backend_settings();
	refresh_settings();

	$('.chosen').chosen();

	$('#enable_frontend,input[name=frontend_option]').on('change', function(){
		refresh_frontend_settings();
	});

	$('#enable_backend,input[name=backend_option]').on('change', function(){
		refresh_backend_settings();
	});

	$('input[name=lookup_mode]').on('change', function(){
		refresh_settings();
	});

	$('input[name=px_lookup_mode]').on('change', function(){
		refresh_settings();
	});

	$('#form_backend_settings').on('submit', function(e){
		if($('#enable_backend').is(':checked')){
			if($('#bypass_code').val().length == 0){
				if(($.inArray($('#my_country_code').val(), $('#backend_ban_list').val()) >= 0 && $('input[name=backend_block_mode]:checked').val() == 1) || ($.inArray($('#my_country_code').val(), $('#backend_ban_list').val()) < 0 && $('input[name=backend_block_mode]:checked').val() == 2)){
					alert("==========\n WARNING \n==========\n\nYou are about to block your own country, " + $('#my_country_name').val() + ".\nThis can locked yourself and prevent you from login to admin area.\n\nPlease set a bypass code to avoid this.");
					$('#bypass_code').focus();
					e.preventDefault();
				}
			}
		}
	});

	$('.ip2location-close').on('click', function() {
		$(this).parent().parent().css('display', 'none');
	});

	$('#download_ip2location_database, #update_ip2location_database').on('click', function(e) {
		e.preventDefault();

		$('#download_token').parent().find('div').remove();

		if ($('#download_token').val().length > 0) {
			$('#download-database-modal').css('display', 'block');

			$('#download_status').html('<span class="dashicons dashicons-update spin"></span> Downloading IP2Location database...');

			$.post(ajaxurl, { action: 'ip2location_country_blocker_download_database', database: 'DB1' }, function(response) {
				response = response.replace(/^\s+|\s+$/g, '');

				if (response == 'SUCCESS') {
					$('#download_status').html('<span class="dashicons dashicons-yes-alt"></span> Successfully updated IP2Location database. Please refresh information by <a href="javascript:;" id="reload">reloading</a> the page.</p></div>');

					$('#reload').on('click', function(){
						window.location = window.location.href.split('#')[0];
					});
				}
				else {
					$('#download_status').html('<span class="dashicons dashicons-warning"></span>' + response);
				}
			}).always(function() {
				$('#database_name').val('');
				
				$('#database_name,#token,#download').prop('disabled', false);
				$('#ip2location-download-progress').hide();
			});
		} else {
			$('#download_token').parent().prepend('<div class="text-danger"><small>Please enter download token.</small></div>');
			$('html, body').animate({
				scrollTop: $('#download_token').offset().top
			}, 500);
		}
	});

	$('#download_ip2proxy_database, #update_ip2proxy_database').on('click', function(e) {
		e.preventDefault();

		$('#download_token').parent().find('div').remove();

		if ($('#download_token').val().length > 0) {
			$('#download-database-modal').css('display', 'block');

			$('#download_status').html('<span class="dashicons dashicons-update spin"></span> Downloading IP2Proxy database...');

			$.post(ajaxurl, { action: 'ip2location_country_blocker_download_database', database: 'PX2' }, function(response) {
				response = response.replace(/^\s+|\s+$/g, '');

				if (response == 'SUCCESS') {
					$('#download_status').html('<span class="dashicons dashicons-yes-alt"></span> Successfully updated IP2Proxy database. Please refresh information by <a href="javascript:;" id="reload">reloading</a> the page.</p></div>');

					$('#reload').on('click', function(){
						window.location = window.location.href.split('#')[0];
					});
				} else if (response == 'SKIP') {
					$('#download_status').html('<span class="dashicons dashicons-warning"></span>IP2Proxy requires at least 512MB memory in your PHP settings to complete the download.');
				} else {
					$.post(ajaxurl, { action: 'ip2location_country_blocker_download_database', database: 'PX1' }, function(response) {
						response = response.replace(/^\s+|\s+$/g, '');

						if (response == 'SUCCESS') {
							$('#download_status').html('<span class="dashicons dashicons-yes-alt"></span> Successfully updated IP2Proxy database. Please refresh information by <a href="javascript:;" id="reload">reloading</a> the page.</p></div>');

							$('#reload').on('click', function(){
								window.location = window.location.href.split('#')[0];
							});
						} else if (response == 'SKIP') {
							$('#download_status').html('<span class="dashicons dashicons-warning"></span>IP2Proxy requires at least 512MB memory in your PHP settings to complete the download.');
						} else {
							$('#download_status').html('<span class="dashicons dashicons-warning"></span>' + response);
						}
					})
						.error(function() {
							$('#download_status').html('<span class="dashicons dashicons-warning"></span> Download skipped. Unable to setup IP2Proxy database due to insufficient system resources.');
						})
						.always(function() {
							$('#database_name').val('');
							
							$('#database_name,#token,#download').prop('disabled', false);
							$('#ip2location-download-progress').hide();
						});
				}
			})
				.error(function() {
					$('#download_status').html('<span class="dashicons dashicons-warning"></span> Download skipped. Unable to setup IP2Proxy database due to insufficient system resources.');
				})
				.always(function() {
					$('#database_name').val('');
					
					$('#database_name,#token,#download').prop('disabled', false);
					$('#ip2location-download-progress').hide();
				});
		} else {
			$('#download_token').parent().prepend('<div class="text-danger"><small>Please enter download token.</small></div>');
			$('html, body').animate({
				scrollTop: $('#download_token').offset().top
			}, 500);
		}
	});

	$('#btn-purge').on('click', function(e) {
		if (!confirm('WARNING: All data will be permanently deleted from the storage. Are you sure you want to proceed with the deletion?')) {
			e.preventDefault();
		}
	});

	$('#btn-get-started').on('click', function(e) {
		e.preventDefault();

		$('#modal-get-started').css('display', 'none');
		$('#modal-step-1').css('display', 'block');
	});

	$('#setup_token').on('input', function() {
		$('#btn-to-step-2').prop('disabled', !($(this).val().length == 64));
	});

	$('#btn-to-step-2').on('click', function(e) {
		e.preventDefault();

		var $btn = $(this);

		$('#token_status').html('<span class="dashicons dashicons-update spin"></span> Validating download token...');
		$btn.prop('disabled', true);

		$.post(ajaxurl, { action: 'ip2location_country_blocker_validate_token', token: $('#setup_token').val() }, function(response) {
			response = response.replace(/^\s+|\s+$/g, '');

			if (response == 'SUCCESS') {
				$('#token_status').html('<span class="dashicons dashicons-yes-alt"></span> Download token is valid.</div>');

				$('#modal-step-1').css('display', 'none');
				$('#modal-step-2').css('display', 'block');
				$('#btn-to-step-3').prop('disabled', true);

				$('#ip2location_download_status').html('<span class="dashicons dashicons-update spin"></span> Downloading IP2Location database...');
				$('#ip2proxy_download_status').html('');

				$.post(ajaxurl, { action: 'ip2location_country_blocker_download_database', database: 'DB1' }, function(response) {
					response = response.replace(/^\s+|\s+$/g, '');

					if (response == 'SUCCESS') {
						$('#ip2location_download_status').html('<span class="dashicons dashicons-yes-alt"></span> IP2Location database successfully downloaded.</p></div>');

						$('#ip2proxy_download_status').html('<span class="dashicons dashicons-update spin"></span> Downloading IP2Proxy database...');

						$.post(ajaxurl, { action: 'ip2location_country_blocker_download_database', database: 'PX1' }, function(response) {
							response = response.replace(/^\s+|\s+$/g, '');

							if (response == 'SUCCESS') {
								$('#ip2proxy_download_status').html('<span class="dashicons dashicons-yes-alt"></span> IP2Proxy database successfully downloaded.</p></div>');

								$('#btn-to-step-3').prop('disabled', false);
							} else if (response == 'SKIP') {
								$('#ip2proxy_download_status').html('<span class="dashicons dashicons-warning"></span> Download skipped. IP2Proxy requires at least 512MB in your PHP settings to complete the download.');
								$('#btn-to-step-3').prop('disabled', false);
							} else {
								$('#ip2proxy_download_status').html('<span class="dashicons dashicons-warning"></span>' + response);
								$('#btn-to-step-3').prop('disabled', false);
							}
						})
							.error(function() {
								$('#ip2proxy_download_status').html('<span class="dashicons dashicons-warning"></span> Download skipped. Unable to setup IP2Proxy database due to insufficient system resources.');
									$('#btn-to-step-3').prop('disabled', false);
							})
							.always(function() {
								$('#btn-to-step-1').prop('disabled', false);
							});
					}
					else {
						$('#ip2location_download_status').html('<span class="dashicons dashicons-warning"></span>' + response);
					}
				}).always(function() {
					$('#btn-to-step-1').prop('disabled', false);
				});
			}
			else {
				$('#token_status').html('<span class="dashicons dashicons-warning"></span>' + response);
			}
		}).always(function() {
		});
	});

	$('#btn-to-step-1').on('click', function(e) {
		e.preventDefault();

		$('#modal-step-1').css('display', 'block');
		$('#modal-step-2').css('display', 'none');
		$('#btn-to-step-2').prop('disabled', false);
	});

	$('#btn-back-to-step-2').on('click', function(e) {
		e.preventDefault();

		$('#modal-step-2').css('display', 'block');
		$('#modal-step-3').css('display', 'none');
	});

	$('#btn-to-step-3').on('click', function(e) {
		e.preventDefault();

		$('#modal-step-3').css('display', 'block');
		$('#modal-step-2').css('display', 'none');

		$('#frontend_ban_list').chosen('destroy').chosen();

		$('input[name="frontend_block_mode"], #frontend_ban_list').on('change', function(e) {
			$('#btn-to-step-4').prop('disabled', true);

			$('.chosen').trigger('chosen:updated');

			if ($('#frontend_ban_list').val().length > 0 && $('input[name="frontend_block_mode"]:checked').length > 0) {
				$('#btn-to-step-4').prop('disabled', false);
			}
		});
	});

	$('#btn-to-step-4').on('click', function() {
		$.post(ajaxurl, { action: 'ip2location_country_blocker_save_rules', mode: $('input[name="frontend_block_mode"]:checked').val(), countries: $('#frontend_ban_list').val() }, function(response) {
			$('#modal-step-3').css('display', 'none');
			$('#modal-step-4').css('display', 'block');
		}).always(function() {
			$('#modal-step-3').css('display', 'none');
			$('#modal-step-4').css('display', 'block');
		});
	});

	function refresh_frontend_settings(){
		if($('#enable_frontend').length == 0)
			return;

		if($('#enable_frontend').is(':checked')){
			$('.input-field,.tagsinput input').prop('disabled', false);

			if($('input[name=frontend_option]:checked').val() != '2'){
				$('#frontend_error_page').prop('disabled', true);
			}

			if($('input[name=frontend_option]:checked').val() != '3'){
				$('#frontend_redirect_url').prop('disabled', true);
			}

			$('.disabled').prop('disabled', true);
			toogleTagsInput(true);
		}
		else{
			$('.input-field').prop('disabled', true);
			toogleTagsInput(false);
		}

		$('.chosen').trigger('chosen:updated');
	}

	function refresh_backend_settings(){
		if($('#enable_backend').length == 0)
			return;

		if($('#enable_backend').is(':checked')){
			$('.input-field,.tagsinput input').prop('disabled', false);

			if($('input[name=backend_option]:checked').val() != '2'){
				$('#backend_error_page').prop('disabled', true);
			}

			if($('input[name=backend_option]:checked').val() != '3'){
				$('#backend_redirect_url').prop('disabled', true);
			}

			$('.disabled').prop('disabled', true);
			toogleTagsInput(true);
		}
		else{
			$('.input-field').prop('disabled', true);
			toogleTagsInput(false);
		}

		$('.chosen').trigger('chosen:updated');
	}

	function refresh_settings(){
		if($('#lookup_mode_bin').is(':checked')){
			$('#bin_database').show();
			$('#bin_download').show();
			$('#ws_access').hide();
		}
		else if($('#lookup_mode_ws').is(':checked')){
			$('#bin_database').hide();
			$('#bin_download').hide();
			$('#ws_access').show();
		}

		if($('#px_lookup_mode_bin').is(':checked')){
			$('#px_bin_database').show();
			$('#bin_download').show();
			$('#px_ws_access').hide();
		}
		else if($('#px_lookup_mode_ws').is(':checked')){
			$('#px_bin_database').hide();
			$('#bin_download').hide();
			$('#px_ws_access').show();
		}
		else{
			$('#px_bin_database').hide();
			$('#px_ws_access').hide();
		}

		if($('#lookup_mode_bin').is(':checked') || $('#px_lookup_mode_bin').is(':checked')){
			$('#bin_download').show();
		}
	}

	function toogleTagsInput(state){
		if(!state){
			$.each($('.tagsinput'), function(i, obj){
				var $div = $('<div class="tagsinput-disabled" style="display:block;position:absolute;z-index:99999;opacity:0.1;background:#808080";top:' + $(obj).offset().top + ';left:' + $(obj).offset().left + '" />').css({
					width: $(obj).outerWidth() + 'px',
					height: $(obj).outerHeight() + 'px'
				});

				$(obj).parent().prepend($div);
			});
		}
		else{
			$('.tagsinput-disabled').remove();
		}
	}
});