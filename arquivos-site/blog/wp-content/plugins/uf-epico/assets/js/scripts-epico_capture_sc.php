jQuery(document).ready(function ($) {

	var $captureSc = $('#cs-<?php echo esc_js( $custom_id ); ?>');

	if ( $captureSc.length ) {

		jQuery.validator.setDefaults({
			success: "valid"
		});

		$('form', $captureSc).validate({
			rules: {
			<?php if( 1 == $atts['email_service']) { ?>
				'EMAIL': {
					required: true,
					email: true
				}
			<?php }
			if( 2 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 3 == $atts['email_service']) { ?>
				'signup[email]': {
					required: true,
					email: true
				}
			<?php }
			if( 4 == $atts['email_service']) { ?>
				'<?php echo implode(", ", (array)$atts['email_field']); ?>': {
					required: true,
					email: true
				}
			<?php }
			if( 5 == $atts['email_service']) { ?>
				'<?php echo implode(", ", (array)$atts['email_field']); ?>': {
					required: true,
					email: true
			}
			<?php }
			if( 6 == $atts['email_service']) { ?>
				email: {
					required: true,
					email: true
				}
			<?php }
			if( 7 == $atts['email_service']) { ?>
				email: {
					required: true,
					email: true
				}
			<?php }
			if( 8 == $atts['email_service']) { ?>
				email: {
					required: true,
					email: true
				}
			<?php }
			if( 9 == $atts['email_service']) { ?>
				'FormValue_Fields[EmailAddress]': {
					required: true,
					email: true
				}
			<?php }
			if( 10 == $atts['email_service']) { ?>
				'email_address': {
					required: true,
					email: true
				}
			<?php }
			if( 11 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 12 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 13 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 14 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 15 == $atts['email_service']) { ?>
				'fldEmail': {
					required: true,
					email: true
				}
			<?php }
			if( 16 == $atts['email_service']) { ?>
				'SMT_email': {
					required: true,
					email: true
				}
			<?php }
			if( 17 == $atts['email_service']) { ?>
				'userdata[email]': {
					required: true,
					email: true
				}
			<?php }
			if( 18 == $atts['email_service']) { ?>
				'da_email': {
					required: true,
					email: true
				}
			<?php }
			if( 19 == $atts['email_service']) { ?>
				'inf_field_Email': {
					required: true,
					email: true
				}
			<?php }
			if( 20 == $atts['email_service']) { ?>
				'email': {
					required: true,
					email: true
				}
			<?php }
			if( 21 == $atts['email_service']) { ?>
				'wysija[user][email]': {
					required: true,
					email: true
				}
			<?php } ?>
			},
			messages: {
			<?php if( 1 == $atts['email_service']) { ?>
				'EMAIL': {
					required: '',
					email: ''
				}
			<?php }
			if( 2 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 3 == $atts['email_service']) { ?>
				'signup[email]': {
					required: '',
					email: ''
				}
			<?php }
			if( 4 == $atts['email_service']) { ?>
				'<?php echo implode(", ", (array)$atts['email_field']); ?>': {
					required: '',
					email: ''
				}
			<?php }
			if( 5 == $atts['email_service']) { ?>
				'<?php echo implode(", ", (array)$atts['email_field']); ?>': {
					required: '',
					email: ''
				}
			<?php }
			if( 6 == $atts['email_service']) { ?>
				email: {
					required: '',
					email: ''
				}
			<?php }
			if( 7 == $atts['email_service']) { ?>
				email: {
					required: '',
					email: ''
				}
			<?php }
			if( 8 == $atts['email_service']) { ?>
				email: {
					required: '',
					email: ''
				}
			<?php }
			if( 9 == $atts['email_service']) { ?>
				'FormValue_Fields[EmailAddress]': {
					required: '',
					email: ''
				}
			<?php }
			if( 10 == $atts['email_service']) { ?>
				'email_address': {
					required: '',
					email: ''
				}
			<?php }
			if( 11 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 12 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 13 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 14 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 15 == $atts['email_service']) { ?>
				'fldEmail': {
					required: '',
					email: ''
				}
			<?php }
			if( 16 == $atts['email_service']) { ?>
				'SMT_email': {
					required: '',
					email: ''
				}
			<?php }
			if( 17 == $atts['email_service']) { ?>
				'userdata[email]': {
					required: '',
					email: ''
				}
			<?php }
			if( 18 == $atts['email_service']) { ?>
				'da_email': {
					required: '',
					email: ''
				}
			<?php }
			if( 19 == $atts['email_service']) { ?>
				'inf_field_Email': {
					required: '',
					email: ''
				}
			<?php }
			if( 20 == $atts['email_service']) { ?>
				'email': {
					required: '',
					email: ''
				}
			<?php }
			if( 21 == $atts['email_service']) { ?>
				'wysija[user][email]': {
					required: '',
					email: ''
				}
			<?php } ?>
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	}

	<?php if ( true == $atts[ 'bkg_img' ] ) { ?>

		function convertHexa( hex, opacity ) {
			hex = hex.replace('#', '');
			r = parseInt(hex.substring(0, 2), 16);
			g = parseInt(hex.substring(2, 4), 16);
			b = parseInt(hex.substring(4, 6), 16);
			result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
			return result;
		}

		<?php if(1 == $atts[ 'overlay' ] ) { ?>

		if ( $captureSc.length ) {

			$captureSc.css(
				'background','-webkit-linear-gradient('	+ convertHexa( "<?php echo implode( ", ", ( array )$atts[ 'overlay_color' ] ); ?>", 80 ) + ',' + convertHexa( "<?php echo implode( ", ", ( array )$atts[ ' overlay_color '] ); ?>", 70 ) + '), url(<?php echo implode( ", ", ( array )$atts[ 'bkg_img' ] ); ?>) 50%'
			).css(
				'background','linear-gradient(' + convertHexa("<?php echo implode( ", ", ( array )$atts[ 'overlay_color' ] ); ?>", 80) + ',' + convertHexa( "<?php echo implode( ", ", ( array )$atts[ 'overlay_color' ] ); ?>",70) + '), url(<?php echo implode( ", ", ( array )$atts[ 'bkg_img' ] ); ?>) 50%'
			).css(
				'background-size','cover'
			);
		}

		<?php } else { ?>

		if ( $captureSc.length ) {

			$captureSc.css({
				'background' : 'transparent url(<?php echo implode( ", ", ( array )$atts[ 'bkg_img' ] ); ?>) 50%',
				'background-size' : 'cover'
			});
		}

		<?php } ?>

	<?php } ?>
});