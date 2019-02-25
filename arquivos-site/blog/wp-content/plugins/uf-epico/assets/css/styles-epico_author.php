<?php if( 1 == $atts[ 'override' ] ) {

	echo '
	section[id*="epico_author"].widget_epico_author-id {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ' !important;
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ' !important;
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'text_color' ] ) ) . ' !important;
		background-image: none !important;
		box-shadow: none !important;
		}

	h3.' . esc_attr( $custom_id ) . '-title,
	p.' . esc_attr( $custom_id ) . '-intro {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'text_color' ] ) ) . ' !important;
		}

	a.' . esc_attr( $custom_id ) . '-button {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_text_color' ] ) ) . ' !important;
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color' ] ) ) . ' !important;
		}

	a.' . esc_attr( $custom_id ) . '-button:hover {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'button_color_hover' ] ) ) . ' !important;
		}';
	}

if( 2 == $atts['stripes'] ) {

	echo '[class*=epc-] #sidebar-primary .widget_epico_author-id:after {
		background: none !important;
	}';

} ?>