<?php
/**
 * Template para a pagina "nao encontrado" (404)
 *
 * Inclui informacoes uteis adicionais ao usuario
 *
 * @package Epico
 * @subpackage 404
 * @since 1.0.0
 */
?>
<?php get_header(); // Loads the header.php template. ?>

<div id="main-container" class="error-404 not-found">

	<div class="wrap">

		<main <?php hybrid_attr( 'content' ); ?>>

			<div class="page-content">

				<header class="page-header">

					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'epico' ); ?></h1>

				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'epico' ); ?></p>

				<?php get_search_form(); ?>

				</header><!-- .page-header -->

				<div class="row">

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( epico_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

					<div class="widget widget_categories">

						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'epico' ); ?></h2>

						<ul>
						<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
						?>
						</ul>

					</div><!-- .widget -->
					<?php endif; ?>

				</div>

			</div><!-- .page-content -->

		</main><!-- #content -->

	</div><!-- .wrap -->

</div><!-- #main-container -->

<?php get_footer(); // Loads the footer.php template. ?>