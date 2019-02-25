<?php if ( 1 == $atts[ 'override' ] ) {

	echo '
	#cs-' . esc_attr( $custom_id ) . '.sc {
		border: 0px;
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ';
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'border_bottom_color' ] ) ) . ';'
		. ( ( ! empty($atts[ 'bkg_img' ] ) ) ? 'background-position: 50%;' :'' ) . '
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture:nth-child(2) {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'form_bkg_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture .capture-title {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'title_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture .capture-icon i::before,
	#cs-' . esc_attr( $custom_id ) . '.sc .capture-inner .capture-iconinner i::before {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'icon_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture .capture-intro {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'intro_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture .capture-intro,
	#cs-' . esc_attr( $custom_id ) . '.sc .capture .capture-intro * {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'intro_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture form input.uf-email {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_color' ] ) ) . ';
		border: 1px solid rgba(0,0,0,0.2);
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_text_color' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture form input.uf-email:focus {
		-webkit-box-shadow: 0px 0px 10px 0px ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ';
		-moz-box-shadow: 0px 0px 10px 0px ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ';
		box-shadow: 0px 0px 10px 0px ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ';
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'email_color' ] ) ) . ';
		border: 1px solid rgba(0,0,0,0.2);
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture form input.uf-submit:hover {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color_hover' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc.capture-wrap .capture-form {
		border-bottom: 0px;
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .capture form input.uf-submit {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ';
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color_text' ] ) ) . ';
		}

	#cs-' . esc_attr( $custom_id ) . '.sc .uf-arrow svg polygon {
		fill: ' . esc_attr( implode( ", ", ( array )$atts[ 'arrow_color' ] ) ) . ' !important;
		}';

	if( false == $atts['bkg_img'] ) {

		echo '
	#cs-' . esc_attr( $custom_id ) . ' .capture-inner:last-child {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ';
	}';
	}
}
?>