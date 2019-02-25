<article <?php hybrid_attr( 'post' ); ?>>

	<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

	<?php if ( is_singular( get_post_type() ) ) : // Se estiver vendo um post unico. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">

				<?php hybrid_post_format_link(); ?>

				<span <?php hybrid_attr( 'entry-author' ); ?>><span itemprop="name"><?php is_multi_author() ? the_author_posts_link() : the_author(); ?></span></span>

				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

				<?php comments_popup_link( __( 'Comment', 'epico' ),  __( '1 comment', 'epico' ), __( '% comments', 'epico' ) , 'comments-link', '' ); ?>

				<?php edit_post_link(); ?>

			</div><!-- .entry-byline -->

			<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'epico' ) ) ); ?>

			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'epico' ), 'before' => '<br />' ) ); ?>

		</footer><!-- .entry-footer -->

	<?php else : // Se NAO estiver vendo um post unico. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

		</div><!-- .entry-content -->

	<?php endif; // Finaliza checagem por posts. ?>

</article><!-- .entry -->