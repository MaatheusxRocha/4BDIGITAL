<?php
/**
 * Template para a barra lateral principal
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_before-content
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'before-content' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'before-content' ); ?>>

		<?php dynamic_sidebar( 'before-content' ); // Apresenta a area de widgets auxiliar. ?>

	</aside><!-- #sidebar-before-content .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>