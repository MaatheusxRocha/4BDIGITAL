<?php
/**
 * Template Name: Lista de autores
 *
 *
 * @package Epico
 * @subpackage Header
 * @since 1.0.2
 */
?>
<?php get_header(); // Carrega o template header.php. ?>


	<?php hybrid_get_menu( 'breadcrumbs' ); // Carrega o template menu/breadcrumbs.php. ?>

	<div id="main-container">

		<div class="wrap">

<?php

	$siteLayout = get_theme_mod( 'epico_sidebar_layout', 1 ); // Opcoes do customizador

	$contentClass = ''; ?>

<?php if ( $siteLayout == 0 ) {

	$contentClass = 'content-right';

} else if ( $siteLayout == 1 ) {

	$contentClass = 'content-left';

}

	// Get all users order by amount of posts
	$allUsers = get_users('orderby=post_count&order=DESC');

	$users = array();

	// Remove subscribers from the list as they won't write any articles
	foreach($allUsers as $currentUser)
	{
		if(!in_array( 'subscriber', $currentUser->roles ))
		{
			$users[] = $currentUser;
		}
	}

?>

			<main id="content" class="content <?php echo esc_html( $contentClass ); ?>" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<?php if ( is_active_sidebar( 'before-content' ) ) : // Se a area de widgets possui widgets. ?>

					<aside id="sidebar-before-content">

						<?php dynamic_sidebar( 'before-content' ); // Apresenta a area de widgets auxiliar. ?>

					</aside><!-- #sidebar-promo .aside -->

			<?php endif; // Finaliza a checagem por widgets. ?>

				<article <?php hybrid_attr( 'post' ); ?>>

					<header class="entry-header">

						<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

						<?php $show_featured = get_post_meta( get_the_ID(), 'epico-show-featured', TRUE ); ?>

						<?php if ( 'on' === $show_featured ) { // Caso o show_featured estiver marcado como `on`. ?>

							<?php the_post_thumbnail(); ?>

						<?php } ?>

						<?php include( locate_template( '/inc/social-buttons.php' ) ); // Adiciona codigo para botoes sociais. ?>

					</header><!-- .entry-header -->

					<div <?php hybrid_attr( 'entry-content' ); ?>>

						<?php the_content(); ?>

						<?php foreach($users as $user) { ?>


						<div class="author-profile vcard<?php if ( user_can( $user->ID, 'editor' ) ) { echo ' editor'; } ?><?php if ( user_can( $user->ID, 'administrator' ) ) { echo ' administrador'; } ?>">

							<h4 class="author-name fn n">

								<a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo $user->display_name; ?></a>

								<?php if ( user_can( $user->ID, 'editor' ) ) { echo ' <span class="editor-tag">' . __( 'Editor' , 'epico' ) . '</span>'; } ?>

								<?php if ( user_can( $user->ID, 'administrator' ) ) { echo ' <span class="editor-tag">' . __( 'Admin' , 'epico' ) . '</span>'; } ?>

							</h4>

							<a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo get_avatar( $user->user_email, '128' ); ?></a>

							<div class="author-description author-bio">

								<p class="author-description-text"><?php echo get_user_meta($user->ID, 'description', true); ?></p>

								<p class="social">

									<?php if ( $twitter = get_user_meta($user->ID, 'twitter', true ) ) { ?>
										<a class="twitter" href="<?php echo esc_url( "http://twitter.com/{$twitter}" ); ?>" title="<?php printf( esc_attr__( '%s on Twitter', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Twitter', 'epico' ); ?></a>
									<?php } ?>

									<?php if ( $facebook = get_user_meta($user->ID, 'facebook', true ) ) { ?>
										<a class="facebook" href="<?php echo esc_url( $facebook ); ?>" title="<?php printf( esc_attr__( '%s on Facebook', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Facebook', 'epico' ); ?></a>
									<?php } ?>

									<?php if ( get_user_meta($user->ID, 'googleplus', true ) ) { ?>
										<a class="google-plus" href="<?php echo esc_url( $googleplus ); ?>" title="<?php printf( esc_attr__( '%s on Google+', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Google+', 'epico' ); ?></a>
									<?php } ?>

								</p>

							</div>

						</div>

						<?php } ?>


					</div><!-- .entry-content -->

					<footer class="entry-footer">

						<?php edit_post_link(); ?>

					</footer><!-- .entry-footer -->

					<?php include( locate_template( '/inc/zen-mode.php' ) ); // Adiciona codigo do modo Zen. ?>

				</article><!-- .entry -->

				<?php hybrid_get_sidebar( 'after-content' ); // Mostra a area de widget after-content. ?>

			</main><!-- #content -->

				<?php hybrid_get_sidebar( 'primary' ); // Carrega o template sidebar/primary.php. ?>

		</div><!-- .wrap -->

	</div><!-- #main-conteiner -->

		<?php get_footer(); // Carrega o template footer.php template. ?>