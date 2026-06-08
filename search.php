<?php
/**
 * @package Becoming_Bipedal_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="site-container">
		<div class="site-main__inner<?php echo is_active_sidebar( 'sidebar-1' ) ? ' site-main__inner--with-sidebar' : ''; ?>">
			<div class="site-main__content">
				<header class="page-header">
					<h1 class="page-header__title">
						<?php printf( esc_html__( 'Search: %s', 'becoming-bipedal-theme' ), get_search_query() ); ?>
					</h1>
				</header>

				<?php if ( have_posts() ) : ?>
					<div class="post-list">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'card' );
						endwhile;
						?>
					</div>
					<?php becoming_bipedal_theme_posts_pagination(); ?>
				<?php else : ?>
					<p class="no-results"><?php esc_html_e( 'No results found.', 'becoming-bipedal-theme' ); ?></p>
					<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
