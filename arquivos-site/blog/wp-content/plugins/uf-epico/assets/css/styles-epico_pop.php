<?php if( 0 == $atts[ 'override' ] ) {

	echo '
	#sidebar-primary .widget_epico_pop-id {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ' !important;
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'text_color' ] ) ) . ' !important;
		border-bottom: 10px solid ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ' !important;
		}

	ul.' . esc_attr( $custom_id ) . '-list a.' . esc_attr( $custom_id ) . '-link {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'text_color' ] ) ) . ' !important;
		}

	h3.' . esc_attr( $custom_id ) . '-title {
		background: ' . esc_attr( implode( ", ", ( array )$atts[ 'title_bkg_color' ] ) ) . ' !important;
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'title_color' ] ) ) . ' !important;
		}

	h3.' . esc_attr( $custom_id ) . '-title:before {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'icon_color' ] ) ) . ' !important;
		}

	ul.' . esc_attr( $custom_id ) . '-list li:before {
		color: rgba(0, 0, 0, 0.2) !important;
		}

	ul.' . esc_attr( $custom_id ) . '-list li:hover:before {
		color: rgba(0, 0, 0, 0.4) !important;
		}';

} ?>