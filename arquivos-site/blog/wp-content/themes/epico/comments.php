<?php
/* Se uma senha de artigo for solicitada ou nenhum comentario for oferecido, e comentarios/pings estiverem fechados, retornar. */
if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) )
	return;
?>
<section id="comments-template">

	<?php if ( have_comments() ) : // Checa se existem comentarios. ?>

		<div id="comments">

			<h3 id="comments-number"><?php comments_number(); ?></h3>

			<ol class="comment-list">
				<?php wp_list_comments(
					array(
						'style'        => 'ol',
						'callback'     => 'hybrid_comments_callback',
						'end-callback' => 'hybrid_comments_end_callback',
					)
				); ?>
			</ol><!-- .comment-list -->

			<?php locate_template( array( 'comment/comments-nav.php' ), true ); // Carrega o template comment/comments-nav.php. ?>

		</div><!-- #comments-->

	<?php endif; // Finaliza a checagem por comentarios. ?>

	<?php locate_template( array( 'comment/comments-error.php' ), true ); // Carrega o template  comment/comments-error.php. ?>

	<?php comment_form(); //Carrega o template de formulario. ?>

</section><!-- #comments-template -->