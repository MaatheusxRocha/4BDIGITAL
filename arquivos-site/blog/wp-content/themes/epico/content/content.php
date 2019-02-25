<article <?php hybrid_attr( 'post' ); ?>>

	<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

	<?php if ( is_singular( get_post_type() ) ) : // Se estiver vendo um post unico. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">

				<span <?php hybrid_attr( 'entry-author' ); ?>><span itemprop="name"><?php is_multi_author() ? the_author_posts_link() : the_author(); ?></span></span>

				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

				<?php comments_popup_link( __( 'Comment', 'epico' ),  __( '1 comment', 'epico' ), __( '% comments', 'epico' ) , 'comments-link', '' ); ?>

				<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( '%s', 'epico' ) ) ); ?>

				<?php edit_post_link(); ?>

			</div><!-- .entry-byline -->

				<?php $show_featured = get_post_meta( get_the_ID(), 'epico-show-featured', TRUE ); ?>

				<?php if ( 'on' === $show_featured ) { // Se o meta box da area de artigos tiver o valor configurado para `ligado` ?>

					<?php the_post_thumbnail(); ?>

				<?php } ?>

			<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

		</div><!-- .entry-content -->


	<?php else : // Se estiver visualizado a listagem de artigos (ou seja, se NAO estiver visualizando um post unico). ?>

		<?php if ( has_post_thumbnail() ) : ?>

			<a class="img-hyperlink" itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject" href="<?php the_permalink() ?>" title="<?php the_title() ?>">

				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'epico-tiny' );

				$alt_text = epico_get_thumbnail_field();

				echo '<img itemprop="contentURL" src="' . esc_url( $image[0] ) . '" alt="' . esc_attr( $alt_text ) .'" />'; ?>

			</a>

		<?php else : ?>

			<a class="no-img-hyperlink" href="<?php the_permalink() ?>" title="<?php the_title() ?>"></a>

		<?php endif ?>

		<?php $compactloop = get_theme_mod( 'epico_compact_loop', 1 ); ?>

		<?php if ( 0 == $compactloop ) : // Se a listagem compacta NAO estiver ativada. ?>

			<div class="entry-byline">

				<span <?php hybrid_attr( 'entry-author' ); ?>><span itemprop="name"><?php is_multi_author() ? the_author_posts_link() : the_author(); ?></span></span>

				<meta itemprop="datePublished" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>" />

				<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( '%s', 'epico' ) ) ); ?>

				<?php if( post_type_supports( get_post_type(), 'comments' ) ) : // Se o tipo de post suporta comentarios ?>

					<?php if( comments_open() ) : // Se os comentarios estiverem abertos ?>

						<span <?php hybrid_attr( 'comments-link-wrap' ); ?>><?php comments_popup_link( __( 'Comment', 'epico' ),  __( '1 comment', 'epico' ), __( '% comments', 'epico' ) , 'comments-link', '' ); ?></span>

					<?php endif; // Finaliza chegagem por comentarios abertos. ?>

				<?php endif; // Finaliza chegagem por suporte a comentarios. ?>

			</div><!-- .entry-byline -->

			<header class="entry-header">

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-summary' ); ?>>

				<?php the_excerpt(); ?>

			</div><!-- .entry-summary -->

		<?php else : // Se a listagem compacta estiver ativada. ?>

			<div class="entry-byline">

				<span <?php hybrid_attr( 'entry-author' ); ?>><span itemprop="name"><?php is_multi_author() ? the_author_posts_link() : the_author(); ?></span></span>

				<meta itemprop="datePublished" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>" />

				<?php
				$categories = get_the_category();
				$separator = ', ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . __( 'Main category:','epico' ) . ' ' . esc_attr( sprintf( __( "%s" ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator;
					}
				echo '<span class="entry-terms category" itemprop="articleSection">' . trim($output, $separator) . '</span>';
				}
				?>

				<span <?php hybrid_attr( 'comments-link-wrap' ); ?>><?php comments_popup_link( '',  '1', '%' , 'comments-link', '' ); ?></span>

			</div><!-- .entry-byline -->

			<header class="entry-header">

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-summary' ); ?>>

				<?php the_excerpt(); ?>

			</div><!-- .entry-summary -->

		<?php endif; // Finaliza checagem por ativacao da listagem compacta. ?>

	<?php endif; // Finaliza chegagem por posts unicos. ?>

	<?php include( locate_template( '/inc/zen-mode.php' ) ); // Adiciona codigo do modo Zen. ?>


</article><!-- .entry -->