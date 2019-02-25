<?php if( 1 == $atts[ 'override' ] ) {

	echo '
	#cw-' . esc_attr( $custom_id ) . ' {
		border: 0px;
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ). ';'
			. ( ( ! empty($atts[ 'bkg_img' ] ) ) ? 'background-position: 50%;' : '' ) . ' !important
		}

	#cw-' . esc_attr( $custom_id ) . '.fw.capture-wrap .capture-form {
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'border_bottom_color' ] ) ) . ' !important;
		}

	.epc-s4.plural #cw-' . esc_attr( $custom_id ) . '.fw,
	.epc-s5.plural #cw-' . esc_attr( $custom_id ) . '.fw,
	.epc-s6.plural #cw-' . esc_attr( $custom_id ) . '.fw {
		border-bottom: none;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture:nth-child(2) {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'form_bkg_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-title {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'title_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-icon i:before,
	#cw-' . esc_attr( $custom_id ) . ' .capture-inner .capture-iconinner i:before {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'icon_color' ] ) ) . ' !important;
		text-shadow: none !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-intro {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'intro_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-intro,
	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-intro * {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'intro_color' ] ) ) . ';
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-notice,
	#cw-' . esc_attr( $custom_id ) . ' .capture .capture-notice * {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'notice_color' ] ) ) . ';
		}

	#cw-' . esc_attr( $custom_id ) . '.ip .capture .capture-notice,
	#cw-' . esc_attr( $custom_id ) . '.ip .capture .capture-notice * {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'title_color' ] ) ) . ';
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture form .uf-email {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_color' ] ) ) . ';
		border: 1px solid rgba(0,0,0,0.2);
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_text_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture form .uf-email:focus {
		box-shadow: 0px 0px 10px 0px ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ';
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_color' ] ) ) . ';
		border: 1px solid rgba(0,0,0,0.2);
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture form  .uf-submit {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ' !important;
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color_text' ] ) ) . ';
		}

	#cw-' . esc_attr( $custom_id ) . ' .capture form .uf-submit:hover {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color_hover' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . ' .uf-arrow svg polygon {
		fill: ' . esc_attr( implode( ", ", ( array )$atts[ 'arrow_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . '.ip.capture-wrap {
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'border_bottom_color' ] ) ) . ';
		}';

	if( false == $atts['bkg_img'] ) {

		echo '
	#cw-' . esc_attr( $custom_id ) . ' .capture-inner:last-child {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ';
		}';
	}

	if( 2 == $atts[ 'sidebar' ] ) {

		echo '
	#cw-' . esc_attr( $custom_id ) . '.sb .capture-close i {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'close_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . '.sb .capture-close i:hover {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ' !important;
		}

	#cw-' . esc_attr( $custom_id ) . '.sb {
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'border_bottom_color' ] ) ) . ';
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ';
		}

	#cw-' . esc_attr( $custom_id ) . '.sb .capture-form {
		border-bottom: 0px !important;
		}

	#cw-' . esc_attr( $custom_id ) . '.sb .capture form .uf-submit {
		height: 48px;
		line-height: 48px;
		}

	#cw-' . esc_attr( $custom_id ) . '.sb .capture .uf-icon:after { top: 15px; }

	@media screen and (min-width:680px) {
		#cw-' . esc_attr( $custom_id ) . '.sb .uf-icon:after { top: 14px }
		}';

	}

} ?>