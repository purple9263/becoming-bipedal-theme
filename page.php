<?php
/**
 * Page template.
 *
 * @package Becoming_Bipedal_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="site-container">
		<div class="site-main__inner<?php echo is_active_sidebar( 'sidebar-1' ) ? ' site-main__inner--with-sidebar' : ''; ?>">
			<div class="site-main__content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
						<header class="single-post__header">
							<?php the_title( '<h1 class="single-post__title">', '</h1>' ); ?>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="single-post__featured">
								<?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
							</figure>
						<?php endif; ?>

						<div class="single-post__content entry-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'becoming-bipedal-theme' ),
									'after'  => '</div>',
								)
							);
							?>
						</div>
					</article>

					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php
get_footer();
