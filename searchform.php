<?php
/**
 * Search form template.
 *
 * @package Becoming_Bipedal_Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search for:', 'becoming-bipedal-theme' ); ?></label>
	<input type="search" id="search-field" class="search-form__field" placeholder="<?php esc_attr_e( 'Search&hellip;', 'becoming-bipedal-theme' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-form__submit"><?php esc_html_e( 'Search', 'becoming-bipedal-theme' ); ?></button>
</form>
