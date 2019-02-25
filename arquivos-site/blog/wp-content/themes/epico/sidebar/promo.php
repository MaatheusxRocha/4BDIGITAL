<?php
/**
 * Template para a barra lateral principal
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_header
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'promo' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'promo' ); ?>>

		<?php dynamic_sidebar( 'promo' ); // Apresenta a area de widgets auxiliar. ?>

	</aside><!-- #sidebar-promo .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>