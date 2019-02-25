<?php if ( is_taxonomy_hierarchical( get_queried_object()->taxonomy ) ) : // Se a taxonomia e hierarquica ?>

	<?php $terms = wp_list_categories(
		array(
			'taxonomy'         => get_queried_object()->taxonomy,
			'child_of'         => get_queried_object_id(),
			'depth'            => 1,
			'title_li'         => false,
			'show_option_none' => false,
			'echo'             => false,
		)
	); ?>

	<?php if ( ! empty( $terms ) ) : // Se uma lista de categorias/termos filho for encontrada. ?>

		<nav <?php hybrid_attr( 'menu', 'sub-terms' ); ?>>

			<ul id="menu-sub-terms-items" class="menu-items">

				<?php echo $terms; ?>

			</ul><!-- .sub-terms -->

		</nav><!-- .menu -->

	<?php endif; // Finaliza chegagem por lista. ?>

 <?php endif; // Finaliza chegagem por hierarquia. ?>