<?php
/**
 * Template para o rodape do tema
 *
 * Apresenta a secao <footer> ate o fim do HTML
 *
 * @package Epico
 * @subpackage Footer
 * @since 1.0.0
 */
?>

		<?php if ( ! is_404() ) {  // Checa se NAO e pagina 404 ?>

			<?php hybrid_get_sidebar( 'subsidiary' ); // Mostra sidebar-subsidiary. ?>

		<?php } ?>

		<footer <?php hybrid_attr( 'footer' ); ?>>

		<?php if ( is_active_sidebar( 'footer' ) ) { // Se houver widgets nesta area ?>

			<div class="wrap footer-widgets">

				<?php hybrid_get_sidebar( 'footer' ); // Carrega o template sidebar/footer.php. ?>

			</div>

		<?php } ?>

			<div id="credits">

				<div class="wrap">

					<div class="credit">

						<p>
							<?php

							$footerText = get_theme_mod( 'epico_footer_txt', __( 'All rights reserved', 'epico' ) );

							$siteDate = get_theme_mod( 'epico_date' );

							$siteNameFooter = get_theme_mod( 'epico_site_name', get_bloginfo( 'name', 'epico' ) );

							$logoFooter = get_theme_mod( 'epico_logo_image_footer' ); ?>

							<?php if ( $logoFooter ) { // Usa o logo se estiver configurado. ?>

							<span itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject" id="footer-logo-img">

								<meta itemprop="name" content="<?php echo esc_attr( $siteName ); ?>">

								<a href="<?php echo esc_url( home_url() ); ?>" rel="home" title=" __( 'Homepage', 'epico' )">

									<img id="footer-logo" src="<?php echo esc_url( $logoFooter ); ?>" itemprop="contentURL" alt="<?php the_title() ?>" />

								</a>

							</span>

							<?php } ?>

							<span id="credit-text"><a href="<?php echo esc_url( home_url() ); ?>" rel="home" title="<?php echo esc_attr( $siteNameFooter ); ?>"><?php echo esc_attr( $siteNameFooter ); ?></a> &#183; <?php epico_copyright_footer( esc_attr( $siteDate ) ); ?>

								<?php if ( $footerText ) { ?>

									<?php echo esc_attr( $footerText ); ?>

								<?php } ?>

							</span>

						</p>

						<?php hybrid_get_menu( 'secondary' ); // Carrega o template menu/social.php. ?>

					</div>

				</div>

			</div>

		</footer><!-- #footer -->

	</div><!-- #page -->

	<?php wp_footer(); // Hook do WordPress para carregar estilos e javascript ao fim do HTML. ?>

</body>

</html>