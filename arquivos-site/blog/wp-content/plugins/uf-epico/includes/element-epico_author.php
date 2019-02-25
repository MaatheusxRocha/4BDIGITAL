		<div class="<?php echo esc_attr( $custom_id ); ?>"  id="<?php echo esc_attr( $custom_id ); ?>" itemscope itemtype="http://schema.org/Person">

			<?php if( isset( $atts[ 'img_src' ] ) ){ ?>

			<a class="<?php echo esc_attr( $custom_id ); ?>-img-link" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> href="<?php echo esc_url( implode(", ", (array)$atts['button_url']) ); ?>"><img class="<?php echo esc_attr( $custom_id ); ?>-img" src="<?php echo esc_url( implode(", ", (array)$atts['img_src']) ); ?>" alt="<?php echo esc_attr( implode(", ", (array)$atts['img_alt']) ); ?>" itemprop="image" /></a>

			<?php } ?>


			<?php if( isset( $atts[ 'title' ] ) ){ ?>

			<h3 class="<?php echo esc_attr( $custom_id ); ?>-title" itemprop="name">

				<?php echo esc_html( implode(", ", (array)$atts['title']) ); ?>

			</h3>

			<?php } ?>

			<?php if( isset( $atts[ 'intro_p' ] ) ){

				$allowed_html =  array(
					'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
					'em' => array(),
					'strong' => array(),
				);
			?>

			<p class="<?php echo esc_attr( $custom_id ); ?>-intro" itemprop="description"><?php echo wp_kses( implode(", ", (array)$atts['intro_p']) , $allowed_html ); ?></p>

			<?php } ?>


			<?php if( isset( $atts[ 'button_txt' ] ) ){ ?>

			<a class="<?php echo esc_attr( $custom_id ); ?>-button" id="<?php echo esc_attr( $custom_id ); ?>" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> href="<?php echo esc_url( implode(", ", (array)$atts['button_url']) ); ?>" itemprop="url"><?php echo esc_html( implode(", ", (array)$atts['button_txt']) ); ?></a>

			<?php } ?>

		</div>
