<?php
/**
 * Template para a barra lateral principal
 *
 * Inclui todo o conteudo da tag <aside> principal
 *
 * @package Epico
 * @subpackage Sidebar_Primary
 * @since 0.1.0
 */
?>
<?php


$siteLayout = get_theme_mod( 'epico_sidebar_layout', 1 );

$sidebarClass = '';

if ( $siteLayout == 0 ) {

	$sidebarClass = 'left';

} else if ( $siteLayout == 1 ) {

	$sidebarClass = 'right';
}
?>

		<aside id="sidebar-primary" class="sidebar <?php echo esc_html( $sidebarClass ); ?>">

			<?php if ( is_active_sidebar( 'primary' ) ) : // Se possui widgets na area auxiliar. ?>

				<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

			<?php else : // If the sidebar has no widgets. ?>

				<?php the_widget(
					'WP_Widget_Text',
					array(
						'title'  => __( 'Example Widget', 'epico' ),
						'text'   => sprintf( __( '<p>This is just an example widget to show how the Primary sidebar looks by default. To enhance your blog and get better results, install the companion Epico plugin and add here the special blog widgets. You can do this from the %scustomize screen%s, in the WordPress admin.</p>', 'epico' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'customize.php' ) . '" onclick="return !window.open(this.href);">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
						'filter' => true,
					),
					array(
						'before_widget' => '<section class="widget widget_text widget_placeholder">',
						'after_widget'  => '</section>',
						'before_title'  => '<h4 class="widget-title">',
						'after_title'   => '</h4>',
					)
				); ?>

			<?php endif; // Finaliza a checagem por widgets. ?>

			<?php hybrid_get_sidebar( 'after-primary' ); // Loads the sidebar/primary.php template. ?>

		</aside><!-- #sidebar-primary -->