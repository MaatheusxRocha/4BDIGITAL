<article <?php hybrid_attr( 'post' ); ?>>

	<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

	<header class="entry-header">

		<h1 class="entry-title not-found"><?php _e( 'Nothing found', 'epico' ); ?></h1>

	</header><!-- .entry-header -->


	<div <?php hybrid_attr( 'entry-content' ); ?>>

		<?php wpautop( __( 'Apologies, but no entries were found.', 'epico' ) ); ?>

	</div><!-- .entry-content -->

</article><!-- .entry -->