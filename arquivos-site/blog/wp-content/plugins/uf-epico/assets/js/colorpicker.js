( function( $ ){
	"use strict";
	$(function () {
		function initColorPicker( widget ) {
			widget.find( '.uf_epico_colorpicker' ).wpColorPicker( {
				change: _.throttle( function() { // For Customizer
					$(this).trigger( 'change' );
				}, 1000 )
			});
		}

		function onFormUpdate( event, widget ) {
			initColorPicker( widget );
		}

		$( document ).on( 'widget-updated', onFormUpdate );
		$( document ).on( 'widget-added', onFormUpdate );

		$( document ).ready( function() {
			$( '#widgets-right .widget:has(.uf_epico_colorpicker)' ).each( function () {
				initColorPicker( $( this ) );
			});
		});
	});
}( jQuery ) );