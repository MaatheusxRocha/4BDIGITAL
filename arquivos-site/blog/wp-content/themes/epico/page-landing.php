<?php
/**
 * Template Name: P&aacute;gina Landing
 *
 * @package Epico
 * @subpackage Header
 * @since 1.0.2
 */
?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<link rel="dns-prefetch" href="//themes.googleusercontent.com">
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php wp_head(); // wp_head ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<?php uberfacil_after_body(); // Hook personalizado - utilizado por padrao para o GTM ?>

	<div id="page">

		<header <?php hybrid_attr( 'header' ); ?>>

				<div class="wrap">

					<div id="branding" itemscope="itemscope" itemtype="http://schema.org/Organization">

					<?php  // Opcoes do customizador para a area de branding

					$siteName = get_theme_mod( 'epico_site_name', get_bloginfo( 'name', 'epico' ) );

					$logoID = get_theme_mod( 'epico_logo_upload' );

					$logoWidth = get_theme_mod( 'epico_logo_width', 280 ); ?>

					<?php if ( $logoID ) { // Utiliza o logotipo se estiver configurado. Caso contrario, usa o titulo do site. ?>

						<p id="site-title" itemprop="name">

							<a itemprop="url" href="<?php echo esc_url( home_url() ); ?>" rel="home" title="Homepage">

								<img style="width: <?php echo esc_attr( $logoWidth ); ?>px" id="logo" itemprop="logo" src="<?php echo esc_url( $logoID ); ?>" alt="<?php echo esc_attr( $siteName ); ?>" />

							</a>

						</p>

					<?php } else { ?>

						<p itemscope itemtype="http://schema.org/Organization"  id="site-title" itemprop="name">

							<a itemprop="url" href="<?php echo esc_url( home_url() ); ?>" rel="home" title="Homepage"><?php echo esc_attr( $siteName ); ?>
							</a>

						</p>

					<?php } ?>

					</div><!-- #branding -->

				</div><!-- .wrap -->

			</header><!-- #header -->

		<div id="main-container">

			<div class="wrap">

				<main id="content" class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

					<?php if ( have_posts() ) : // Checa se algum post foi encontrado. ?>

						<?php while ( have_posts() ) : // Inicia o loop para os posts encontrados. ?>

							<?php the_post(); // Carrega o template post data. ?>

							<?php hybrid_get_content_template(); // Carrega um dos templates em content/*.php. ?>

						<?php endwhile; // Finaliza o loop com os posts encontrados. ?>

					<?php endif; // Finaliza a checagem por posts. ?>

				</main><!-- #content -->

			</div><!-- .wrap -->

		</div><!-- #main-conteiner -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div id="credits">

				<div class="wrap">

					<div class="credit">

						<p>
							<?php

							$footerText = get_theme_mod( 'epico_footer_txt', __( 'All rights reserved', 'epico' ) );

							$siteDate = get_theme_mod( 'epico_date' );

							$siteNameFooter = get_theme_mod( 'epico_site_name', get_bloginfo( 'name', 'epico' ) ); ?>

							<span id="credit-text"><a href="<?php echo esc_url( home_url() ); ?>" rel="home" title="<?php echo esc_attr( $siteNameFooter ); ?>"><?php echo esc_attr( $siteNameFooter ); ?></a> &#183; <?php epico_copyright_footer( esc_attr( $siteDate ) ); ?>

								<?php if ( $footerText ) { ?>

									<?php echo esc_attr( $footerText ); ?>

								<?php } ?>

							</span>

						</p>

					</div>

				</div>

			</div>

		</footer><!-- #footer -->

	</div><!-- #page -->

	<?php wp_footer(); // Hook do WordPress para carregar estilos e javascript ao fim do HTML. ?>

</body>

</html>