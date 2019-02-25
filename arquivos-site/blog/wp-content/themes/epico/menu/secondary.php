<!-- Menu de navegacao secundario -->

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>

		<?php $secondarymenu = wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'menu-secondary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => 'epico_link_to_menu_editor',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>',
				'echo'            => FALSE
			)
		);
		echo $secondarymenu;
		?>

	</nav><!-- #menu-secondary -->