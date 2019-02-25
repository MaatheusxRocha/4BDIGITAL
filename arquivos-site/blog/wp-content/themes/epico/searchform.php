<?php
/**
 * default search form
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" placeholder="<?php _e( '&#xf002; Search for:', 'epico' ); ?>" name="s" class="search-field fa" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <input class="search-submit fa fa-search" type="submit" value="<?php _e( 'Go &#xf0a9;', 'epico' ); ?>" />
</form>