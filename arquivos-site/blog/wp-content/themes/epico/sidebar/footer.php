<?php
/**
 * Template para a area de widgets do rodape
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_Footer
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'footer' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'footer' ); ?>>

		<?php dynamic_sidebar( 'footer' ); // Apresenta a area de widgets auxiliar. ?>

	</aside><!-- #sidebar-footer .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>