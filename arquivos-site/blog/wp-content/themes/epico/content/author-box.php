<div class="author-profile vcard" role="contentinfo">

	<h4 class="author-name fn n" itemscope itemtype="http://data-vocabulary.org/Person">
		<?php printf( __( 'About %s', 'epico' ), '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><span itemprop="name">' . get_the_author_meta( 'display_name' ) . '</span></a>' ); ?>
	</h4>

	<?php echo get_avatar( get_the_author_meta( 'user_email' ), '96' ); ?>

	<div class="author-description author-bio">

	<?php if ( $description = get_the_author_meta( 'description' ) ) { ?>

		<?php echo wpautop( $description ); ?>

	<?php } else { ?>

		<?php printf( __( '<p>This area is reserved for the author biography and must be edited for each site author. This setting can be found in the %sBiographical Info%s section, in the admin panel. If you wish to include links for the author\'s social networks, we recommend that you install the WordPress SEO plugin. After installed, it will appropriately create fields for each social network in the user administration panel. After filled, they will appear automatically here.</p>', 'epico' ), current_user_can( 'publish_posts' ) ? '<a href="' . admin_url( 'profile.php#email' ) . '" onclick="return !window.open(this.href);">' : '', current_user_can( 'publish_posts' ) ? '</a>' : '' ); ?>

	<?php } ?>

		<p class="social">
			<?php if ( $twitter = get_the_author_meta( 'twitter' ) ) { ?>
				<a class="twitter" itemprop="url" href="<?php echo esc_url( "http://twitter.com/{$twitter}" ); ?>" title="<?php printf( esc_attr__( '%s on Twitter', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Twitter', 'epico' ); ?></a>
			<?php } ?>

			<?php if ( $facebook = get_the_author_meta( 'facebook' ) ) { ?>
				<a class="facebook" itemprop="url" href="<?php echo esc_url( $facebook ); ?>" title="<?php printf( esc_attr__( '%s on Facebook', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Facebook', 'epico' ); ?></a>
			<?php } ?>

			<?php if ( $googleplus = get_the_author_meta( 'googleplus' ) ) { ?>
				<a class="google-plus" itemprop="url" href="<?php echo esc_url( $googleplus ); ?>?rel=author" title="<?php printf( esc_attr__( '%s on Google+', 'epico' ), get_the_author_meta( 'display_name' ) ); ?>"><?php _e( 'Google+', 'epico' ); ?></a>
			<?php } ?>
		</p>

	</div>
</div>