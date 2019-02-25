	<div class="uf_epicosocial" id="es-<?php echo esc_attr( $custom_id ); ?>">

		<?php if(isset($atts['title'])){ ?>

		<h3 class="<?php echo esc_attr( $custom_id ); ?>-title">
			<?php echo esc_attr( implode(", ", (array)$atts['title']) ); ?>
		</h3>

		<?php } ?>


		<ul class="<?php echo esc_attr( $custom_id ); ?>-list">

		<?php $i = 1; foreach((array) $groups['social'] as $increment=>$context){ ?>

			<?php if(1 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Facebook" class="fa fa-facebook" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(2 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a  title="YouTube" class="fa fa-youtube" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(3 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Google+" class="fa fa-google-plus" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(4 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Twitter" class="fa fa-twitter" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(5 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Linkedin" class="fa fa-linkedin" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(6 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Flickr" class="fa fa-flickr" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


			<?php if(7 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Foursquare" class="fa fa-foursquare" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>

			<?php if(8 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Pinterest" class="fa fa-pinterest" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>

			<?php if(9 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Instagram" class="fa fa-instagram" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>

			<?php if(10 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Soundcloud" class="fa fa-soundcloud" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>

			<?php if(11 == $context['social']){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item"><a title="Slideshare" class="fa fa-slideshare" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> id="<?php echo esc_attr( $custom_id ) . $i++; ?>" href="<?php echo ( ! empty( $context['social_link'] ) ? esc_url( $context['social_link'] )  : '#' ); ?>"></a></li>

			<?php } ?>


		<?php } ?>

		</ul>

	</div>