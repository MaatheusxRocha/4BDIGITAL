<?php

/**
 * Renderiza a opcao do meta box.
 *
 * @package	    Epico
 * @subpackage  Featured metabox display
 * @version     1.0.0
 * @since       1.0.0
 *
 */

?>
<div class="meta-options">

	<label for="epico-show-featured">
		<input type="checkbox" id="epico-show-featured" name="epico-show-featured" <?php checked( get_post_meta( get_the_ID(), 'epico-show-featured', true ), 'on', true ); ?> />
		<?php _e( 'Show featured image in content' , 'epico' ); ?>
	</label>

	<?php
		// Definindo o nonce para efeito de seguranca.
		wp_nonce_field( 'epico-show-featured', 'epico-show-featured-nonce' );
	?>

</div><!-- .meta-options -->
