<?php
/**
 * Template part for displaying a message when no posts are found.
 *
 * @package Becoming_Bipedal_Theme
 */
?>

<section class="no-results">
	<header class="page-header">
		<h1 class="page-header__title"><?php esc_html_e( 'Nothing Found', 'becoming-bipedal-theme' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %s: link to create a new post */
						__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'becoming-bipedal-theme' ),
						array( 'a' => array( 'href' => array() ) )
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'becoming-bipedal-theme' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'becoming-bipedal-theme' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
