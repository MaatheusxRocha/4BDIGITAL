<?php
/**
 * Template de cabecalho para o tema
 *
 * Apresenta a secao <head> ate a tag <header>
 *
 * @package Epico
 * @subpackage Header
 * @since 1.0.0
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

	<?php if ( ! is_404() ) {  // Checar se NAO e pagina 404 ?>

		<?php hybrid_get_sidebar( 'top' ); // Mostra a sidebar do topo. ?>

	<?php } ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<div class="wrap">

				<div id="branding">

				<?php  // Opcoes do customizador para a area de branding


				$siteName = get_theme_mod( 'epico_site_name', get_bloginfo( 'name', 'epico' ) );

				$logoID = get_theme_mod( 'epico_logo_upload' );

				$logoWidth = get_theme_mod( 'epico_logo_width', 280 ); ?>

				<?php if ( $logoID ) { // Utiliza o logotipo se estiver configurado. Caso contrario, usa o titulo do site. ?>

					<p id="site-title" itemscope itemtype="http://schema.org/Organization">

						<a itemprop="url" href="<?php echo esc_url( home_url() ); ?>" rel="home" title="Homepage">

							<meta itemprop="name" content="<?php echo esc_attr( $siteName ); ?>">

							<img style="width: <?php echo esc_attr( $logoWidth ); ?>px" id="logo" itemprop="image logo" src="<?php echo esc_url( $logoID ); ?>" alt="<?php echo esc_attr( $siteName ); ?>" />

						</a>

					</p>

				<?php } else { ?>

					<p id="site-title" itemscope itemtype="http://schema.org/Organization">

						<a itemprop="url" href="<?php echo esc_url( home_url() ); ?>" rel="home" title="Homepage">

							<span itemprop="name"><?php echo esc_attr( $siteName ); ?></span>

						</a>

					</p>

				<?php } ?>

				</div><!-- #branding -->

				<div class="nav" id="nav">

					<?php hybrid_get_menu( 'primary' ); // Carrega o template em menu/primary.php. ?>

				<div id="search-wrap">

					<a id="search-toggle" href="#" title="<?php _e( 'Search', 'epico' ); ?>"><span class="search-text"><?php _e( 'Search', 'epico' ); ?></span></a>

					<?php get_search_form(); ?>

				</div>

				</div>

			</div><!-- .wrap -->

		</header><!-- #header -->

			<?php if ( ! is_404() ) :  // Checar se NAO esta na pagina 404 ?>

				<?php hybrid_get_sidebar( 'promo' ); // Mostra sidebar-promo. ?>

			<?php endif; // Fim da opcao para checar pagina 404. ?>