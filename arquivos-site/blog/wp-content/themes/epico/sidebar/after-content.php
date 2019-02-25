<?php
/**
 * Template para a barra lateral principal
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_after-content
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'after-content' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'after-content' ); ?>>

		<?php dynamic_sidebar( 'after-content' ); // Apresenta a area de widgets auxiliar. ?>

	</aside><!-- #sidebar-after-content .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>