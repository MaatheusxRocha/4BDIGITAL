<?php if( 1 == $atts[ 'override' ] ) {

	echo '
	ul.' . esc_attr( $custom_id ) . '-list li a {
		background-color: ' . esc_attr( implode( ", ", ( array )$atts[ 'bkg_color' ] ) ) . ' !important;
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'text_color' ] ) ) . ' !important;
		}
	ul.' . esc_attr( $custom_id ) . '-list li a:before {
		color: ' . esc_attr( implode( ", ", ( array )$atts[ 'icon_color' ] ) ) . ' !important;
		}
	';
}

if( 2 == $atts[ 'link_bold' ] ) {

	echo '
	#page #sidebar-primary section[class*="epico_links"] li a {
		font-weight: 600;
		}';
}
?>