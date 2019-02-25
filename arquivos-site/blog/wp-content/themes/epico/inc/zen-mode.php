<?php

/**
 * Opcoes do customizador para o modo zen
 *
 * @package	    Epico
 * @subpackage  Zen Mode
 * @version     1.0.0
 * @since       1.0.0
 *
 */
?>

<?php if ( is_singular() ) { ?>

		<?php  // Opcoes do customizador para o zen mode

			$zenMode = get_theme_mod( 'epico_zenmode', 1 );

			$zenModetext = get_theme_mod( 'epico_zenmode_text', __( 'Focused reading', 'epico' ) ); ?>

		<?php if ( $zenMode == 1 ) { ?>

			<span id="zen" aria-hidden="true">

					<span class="zen-text">

						<?php if ( isset( $zenModetext ) ) {

							echo esc_html( $zenModetext );

						} ?>

					</span>

					<i class="fa fa-power-off fadein"></i>

			</span>

		<?php } ?>

	<?php } ?>
