<?php

/**
 * Opcoes do customizador para a area de botoes sociais
 *
 * @package		Epico
 * @subpackage	Social buttons
 * @version    1.0.0
 * @since      1.0.0
 *
 */

	$socialSticky = get_theme_mod( 'epico_socialstickybox', 1 );

	$socialPartialCounter = get_theme_mod( 'epico_socialpartialcount', 0 );

	$socialClose = get_theme_mod( 'epico_socialclose', 1 );

	$socialStyles = get_theme_mod( 'epico_socialstyles', 0 );

	$socialFacebook = get_theme_mod( 'epico_socialfacebook', 1 );

	$socialTwitter = get_theme_mod( 'epico_socialtwitter', 1 );

	$socialGoogle = get_theme_mod( 'epico_socialgoogle', 1 );

	$socialLinkedin = get_theme_mod( 'epico_sociallinkedin', 1 );

	$socialPinterest = get_theme_mod( 'epico_socialpinterest', 1 );

	$socialWhatsapp = get_theme_mod( 'epico_socialwhatsapp', 1 );

	$content = get_the_content('');

?>

<?php if ( is_page() ) {

	$socialPlacement = get_theme_mod( 'epico_socialpages', 0 );

} else {

	$socialPlacement = get_theme_mod( 'epico_socialposts', 1 );

} ?>


				<?php if ( $socialPlacement == 1 && ! is_attachment() ) { ?>

				<div <?php if ( $socialSticky == 1 ) { ?> id="social-bar-sticky" <?php } ?> class="social-bar">

					<ul class="social-likes social-likes_notext <?php if ( $socialStyles == 0 ) { ?>social-likes-colorful<?php } ?>" <?php if ( $socialPartialCounter == 0 ) { ?>data-counters="no"<?php } ?>>

						<?php if ( $socialFacebook == 1 ) { ?>

							<li class="facebook" title="<?php _e( 'Share on Facebook', 'epico' ); ?>"></li>

						<?php } ?>

						<?php if ( $socialTwitter == 1 ) { ?>

							<li class="twitter" title="<?php _e( 'Share on Twitter', 'epico' ); ?>"></li>

						<?php } ?>

						<?php if ( $socialGoogle == 1 ) { ?>

							<li class="plusone" title="<?php _e( 'Share on Google+', 'epico' ); ?>"></li>

						<?php } ?>

						<?php if ( $socialPinterest == 1 ) { ?>

						<?php

							$thumb_id        = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
							$thumb_url       = $thumb_url_array[0];
						?>

							<li class="pinterest" data-media="<?php echo esc_url( $thumb_url ); ?>" title="<?php _e( 'Share on Pinterest', 'epico' ); ?>"></li>

						<?php } ?>

						<?php if ( $socialLinkedin == 1 ) { ?>

							<li class="linkedin" title="<?php _e( 'Share on LinkedIn', 'epico' ); ?>"></li>

						<?php } ?>


						<?php $detect = new Mobile_Detect; // mobile-detect/mobile-detect.php

						 if ( $socialWhatsapp == 1 && $detect->isMobile() && ! $detect->isTablet()) { ?>

							<li class="social-likes__widget social-likes__widget_whatsapp" title="<?php _e( 'Share via WhatsApp', 'epico' ); ?>">

								<a href="whatsapp://send?text=<?php echo urlencode( get_the_title() ) . '%20-%20' .  urlencode( esc_url( get_permalink() ) ) . '%3Futm_source%3DWhatsApp%2526utm_medium%3DIM%2526amp%3Butm_campaign%3Dwhatsapp"'; ?>">
									<span class="social-likes__button social-likes__button_whatsapp">
										<span class="social-likes__icon social-likes__icon_whatsapp"></span>
									</span>
								</a>
							</li>

						<?php } ?>

					</ul>

					 <?php if ( $socialClose == 1 ) { ?>

						<span id="social-close" aria-hidden="true"><i class="fa fa-times-circle fadein"></i></span>

					<?php } ?>

				</div>

				<?php } // Finaliza a checagem por ativacao em posts. ?>