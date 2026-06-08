<?php
/**
 * Archive template.
 *
 * @package Becoming_Bipedal_Theme
 */

get_header();

$current_term = get_queried_object();
$ja_title = '';
$en_title = '';

if ( $current_term instanceof WP_Term ) {
	$ja_title = $current_term->name;
	if ( ! empty( $current_term->description ) ) {
		$en_title = $current_term->description;
	} else {
		$slug = $current_term->slug;
		$en_title = str_replace( '-', ' ', ucwords( $slug, '-' ) );
		$en_title = str_ireplace( 'ai', 'AI', $en_title );
	}
} else {
	$ja_title = get_the_archive_title();
	$en_title = 'Archive';
}
?>

<main id="primary" class="site-main site-main--archive">
	<div class="site-container">
		<header class="archive-header">
			<div class="archive-header__inner">
				<h1 class="archive-header__en"><?php echo esc_html( $en_title ); ?></h1>
				<p class="archive-header__ja"><?php echo esc_html( $ja_title ); ?></p>
			</div>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="archive-post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile;
				?>
			</div>
			<?php becoming_bipedal_theme_posts_pagination(); ?>
		<?php else : ?>
			<div class="archive-no-results">
				<p class="no-results"><?php esc_html_e( 'No posts found.', 'becoming-bipedal-theme' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
