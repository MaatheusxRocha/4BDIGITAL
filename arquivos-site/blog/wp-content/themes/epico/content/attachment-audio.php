	<?php if ( is_attachment() ) : // Se estiver vendo um anexo unico. ?>

		<article <?php hybrid_attr( 'post' ); ?>>

			<meta itemprop="inLanguage" content="<?php echo get_bloginfo('language'); ?>"/>

			<?php hybrid_attachment(); // Funcao para lidar com anexos que nao sejam imagens. ?>

			<header class="entry-header">

				<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

				<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php the_content(); ?>

				<?php wp_link_pages(); ?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">

				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>

				<?php edit_post_link(); ?>

			</footer><!-- .entry-footer -->

		</article><!-- .entry -->

		<div class="attachment-meta">

			<div class="media-info">

				<h3><?php _e( 'Audio Info', 'epico' ); ?></h3>

				<?php hybrid_media_meta(); ?>

			</div><!-- .media-info -->

		</div><!-- .attachment-meta -->

	<?php else : // Se NAO estiver vendo um anexo unico. ?>

		<article <?php hybrid_attr( 'post' ); ?>>

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

		</article><!-- .entry -->

	<?php endif; // Finaliza checagem por anexos. ?>