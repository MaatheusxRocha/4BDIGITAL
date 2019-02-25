<?php
/**
 * Template para a area de widgets do rodape
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_Subsidiary
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'subsidiary' ) ) : // Se possui widgets na area auxiliar. ?>

	<aside <?php hybrid_attr( 'sidebar', 'subsidiary' ); ?>>

		<div class="wrap">

			<?php dynamic_sidebar( 'subsidiary' ); ?>

		</div>

	</aside><!-- #sidebar-subsidiary .aside -->

 <?php endif; // Finaliza a checagem por widgets. ?>