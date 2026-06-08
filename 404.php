<?php
/**
 * @package Becoming_Bipedal_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="site-container">
		<section class="no-results">
			<h1 class="page-header__title"><?php esc_html_e( '404 Not Found', 'becoming-bipedal-theme' ); ?></h1>
			<p><?php esc_html_e( 'The page you requested could not be found.', 'becoming-bipedal-theme' ); ?></p>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'becoming-bipedal-theme' ); ?></a></p>
		</section>
	</div>
</main>

<?php get_footer(); ?>
