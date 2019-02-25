<article <?php hybrid_attr( 'post' ); ?>>

	<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php hybrid_post_format_link(); ?>

			<span <?php hybrid_attr( 'entry-author' ); ?>><span itemprop="name"><?php is_multi_author() ? the_author_posts_link() : the_author(); ?></span></span>

			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

			<?php edit_post_link(); ?>

			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'epico' ) ) ); ?>

			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'epico' ), 'before' => '<br />' ) ); ?>

		</footer><!-- .entry-footer -->

	<?php else : // Se estiver visualizando a lista de artigos. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php hybrid_post_format_link(); ?>

			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

			<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php _e( 'Permalink', 'epico' ); ?></a>

			<?php comments_popup_link( __( 'Comment', 'epico' ),  __( '1 comment', 'epico' ), __( '% comments', 'epico' ) , 'comments-link', '' ); ?>

		</footer><!-- .entry-footer -->

	<?php endif; // Finaliza checagem por artigos. ?>

	<?php include( locate_template( '/inc/zen-mode.php' ) ); // Adiciona codigo do modo Zen. ?>

</article><!-- .entry -->