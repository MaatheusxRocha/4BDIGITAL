<?php
/**
 * Template Name: Largura total
 *
 *
 * @package Epico
 * @subpackage Header
 * @since 1.0.2
 */
?>
<?php get_header(); // Carrega o template header.php. ?>

	<div id="main-container">

		<div class="wrap">

			<main id="content" class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

				<?php if ( have_posts() ) : // Checa se algum post foi encontrado. ?>

					<?php while ( have_posts() ) : // Inicia o loop para os posts encontrados. ?>

						<?php the_post(); // Carrega o template post data. ?>

						<?php hybrid_get_content_template(); // Carrega um dos templates em content/*.php. ?>

						<?php if ( is_singular() ) : // Se estiver visualizando um post unico ou pagina. ?>

							<?php hybrid_get_sidebar( 'after-content' ); // Mostra a area de widget after-content. ?>

						<?php endif; // Finaliza a chegagem de posts unicos ou paginas.. ?>

					<?php endwhile; // Finaliza o loop com os posts encontrados. ?>

				<?php endif; // Finaliza a checagem por posts. ?>

			</main><!-- #content -->

		</div><!-- .wrap -->

	</div><!-- #main-conteiner -->

	<?php get_footer(); // Carrega o template footer.php template. ?>