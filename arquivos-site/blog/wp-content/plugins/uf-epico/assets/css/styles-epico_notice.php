<?php if(1 == $atts['override']){ ?>

	.uberaviso{
		background:<?php echo esc_attr( implode(", ", (array)$atts['bkg_color']) ); ?> !important;
		color:<?php echo esc_attr( implode(", ", (array)$atts['text_color']) ); ?> !important;
		}

	.uberaviso .<?php echo esc_attr( $custom_id ); ?>-button{
		color:<?php echo esc_attr( implode(", ", (array)$atts['button_text_color']) ); ?> !important;
		background:<?php echo esc_attr( implode(", ", (array)$atts['button_color']) ); ?> !important;
		}

	.uberaviso .<?php echo esc_attr( $custom_id ); ?>-button:hover{
		background:<?php echo esc_attr( implode(", ", (array)$atts['button_bkg_color_hover']) ); ?> !important;
		}

	.uberaviso-close{
		color:<?php echo esc_attr( implode(", ", (array)$atts['button_color']) ); ?> !important;
		}

	.uberaviso-close:hover{
		color:<?php echo esc_attr( implode(", ", (array)$atts['button_bkg_color_hover']) ); ?> !important;
		}

<?php } ?>
