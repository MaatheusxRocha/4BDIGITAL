		<div class="<?php echo esc_attr( $custom_id ); ?>" id="ep-<?php echo esc_attr( $custom_id ); ?>" itemscope itemtype="http://schema.org/ItemList">

			<meta itemprop="itemListOrder" content="Descending" />

			<?php if(isset($atts['title'])){ ?>

			<h3 class="<?php echo esc_attr( $custom_id ); ?>-title <?php echo esc_attr( implode(", ", (array)$atts['icon']) ); ?>" itemprop="name">
				<?php echo esc_attr( implode(", ", (array)$atts['title']) ); ?>
			</h3>

			<?php } ?>

			<?php if(isset($atts['article'])){ ?>

			<ul class="<?php echo esc_attr( $custom_id ); ?>-list">
				<?php $i = 1; foreach((array) $groups['article'] as $increment=>$context){ ?>

					<li class="<?php echo esc_attr( $custom_id ); ?>-item" itemprop="itemListElement"><a class="<?php echo esc_attr( $custom_id ); ?>-link" id="<?php echo esc_attr( $custom_id ) . $i++; ?>" <?php echo ( ( 0 == $atts[ 'target' ] ) ? 'target="_blank"' : '' )  ?> href="<?php echo esc_url (get_permalink( $context['article'] ) ); ?>" itemprop="url"><?php echo esc_html( get_the_title( $context['article'] ) ); ?> </a></li>

				<?php } ?>

			</ul>

			<?php } ?>

		</div>