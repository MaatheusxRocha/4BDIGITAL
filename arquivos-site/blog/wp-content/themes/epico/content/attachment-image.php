	<article <?php hybrid_attr( 'post' ); ?>>

		<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

		<?php if ( is_attachment() ) : // Se estiver vendo um anexo unico. ?>

			<?php if ( has_excerpt() ) : // Se a imagem possui um resumo/legenda. ?>

				<?php $src = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>

				<?php echo img_caption_shortcode( array( 'align' => 'alignleft', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) ); ?>

			<?php else : // Se a imagem NAO possui um resumo/legenda. ?>

				<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>

			<?php endif; // Finaliza checagem pela legenda da imagem. ?>

			<header class="entry-header">

				<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

				<div class="entry-byline">

					<span class="image-sizes"><?php printf( __( 'Sizes: %s', 'epico' ), hybrid_get_image_size_links() ); ?></span>

				</div><!-- .entry-byline -->

			<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-content' ); ?>>

				<?php the_content(); ?>

				<?php wp_link_pages(); ?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">

				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

				<?php edit_post_link(); ?>

			</footer><!-- .entry-footer -->

		<?php else : // Se estiver vendo um anexo unico. ?>

			<?php if ( has_post_thumbnail() ): ?>

				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">

					<?php the_post_thumbnail() ?>

				</a>

			<?php endif ?>

			<header class="entry-header">

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-summary' ); ?>>

				<?php the_excerpt(); ?>

			</div><!-- .entry-summary -->


		<?php endif; //  Finaliza checagem por anexos unicos. ?>

	</article><!-- .entry -->

	<?php if ( is_attachment() ) : // Se estiver visualizando um anexo unico. ?>

		<div class="attachment-meta">

			<div class="media-info image-info">

				<h3 class="attachment-meta-title"><?php _e( 'Image Info', 'epico' ); ?></h3>

				<?php hybrid_media_meta(); ?>

			</div><!-- .media-info -->

			<?php $gallery = gallery_shortcode( array( 'columns' => 4, 'numberposts' => 8, 'orderby' => 'rand', 'id' => get_queried_object()->post_parent, 'exclude' => get_the_ID() ) ); ?>

			<?php if ( ! empty( $gallery ) ) : // Checa se a galeria NAO esta vazia. ?>

				<div class="image-gallery">

					<h3 class="attachment-meta-title"><?php _e( 'Gallery', 'epico' ); ?></h3>

					<?php echo $gallery; ?>

				</div>

			<?php endif; // Finaliza checagem por galerias. ?>

		</div><!-- .attachment-meta -->

	<?php endif; // Finaliza checagem por anexos unicos. ?>
