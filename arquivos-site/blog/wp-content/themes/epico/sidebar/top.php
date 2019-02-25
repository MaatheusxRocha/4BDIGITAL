<?php
/**
 * Template para a area de widgets do topo do site
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_Top
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'top' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'top' ); ?>>

		<div class="wrap">

			<?php dynamic_sidebar( 'top' ); // Apresenta a area de widgets auxiliar. ?>

		</div>

	</aside><!-- #sidebar-top .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>