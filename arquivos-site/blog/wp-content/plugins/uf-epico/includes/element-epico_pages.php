		<?php if( ! empty($atts['page_id'])){ ?>

		<ul class="<?php echo esc_attr( $custom_id ); ?>-list">
			<?php $i = 1; foreach((array) $groups['page_id'] as $increment=>$context){ ?>

			<li class="<?php echo esc_attr( $custom_id ); ?>-item">

				<a class="<?php echo esc_attr( $context['icon'] ); ?>" id="<?php echo esc_attr( $custom_id ) . $i++; ?>" title="<?php echo esc_attr( $context['page_title'] ); ?>" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> href="<?php echo esc_url( get_permalink( $context['page_id'] ) ); ?>"><?php echo esc_html( $context['page_title'] ); ?></a>

			</li>

			<?php } ?>

		</ul>

		<?php } ?>