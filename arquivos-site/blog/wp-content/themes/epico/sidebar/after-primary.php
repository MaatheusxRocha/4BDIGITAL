<?php
/**
 * Template para a barra lateral principal
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_after-primary
 * @since 0.1.0
 */
?>
<?php if ( is_active_sidebar( 'after-primary' ) ) : // Se possui widgets na area auxiliar. ?>

	<div id="after-primary">

		<?php dynamic_sidebar( 'after-primary' ); // Apresenta a area de widgets auxiliar. ?>

	</div><!-- #sidebar-after-primary section -->

 <?php endif; // Finaliza a checagem por widgets. ?>