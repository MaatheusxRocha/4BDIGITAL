<div <?php hybrid_attr( 'loop-meta' ); ?>>

	<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>

	<?php if ( is_category() || is_tax() ) : // Se estiver visualizando uma categoria ou taxonomia personalizada. ?>

		<?php hybrid_get_menu( 'sub-terms' ); // Carrega o template em menu/sub-terms.php. ?>

	<?php endif; // Finaliza chegagem por taxnonomia. ?>

	<?php if ( ! is_paged() && $desc = hybrid_get_loop_description() ) : // Chega se estamos em um conteudo paginado. ?>

		<div <?php hybrid_attr( 'loop-description' ); ?>>

			<?php echo $desc; ?>

		</div><!-- .loop-description -->

	<?php endif; // Finaliza chegagem por conteudo paginado. ?>

</div><!-- .loop-meta -->