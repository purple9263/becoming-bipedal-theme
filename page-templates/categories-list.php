<?php
/**
 * Template Name: Categories List
 * Description: Displays a list of all categories with post counts.
 *
 * @package Becoming_Bipedal_Theme
 */

get_header();

$categories = get_categories(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
	)
);
?>

<main id="primary" class="site-main">
	<div class="site-container">
		<div class="site-main__inner<?php echo is_active_sidebar( 'sidebar-1' ) ? ' site-main__inner--with-sidebar' : ''; ?>">
			<div class="site-main__content">
				<?php while ( have_posts() ) : the_post(); ?>
					<header class="page-header">
						<?php the_title( '<h1 class="page-header__title">', '</h1>' ); ?>
						<?php if ( get_the_content() ) : ?>
							<div class="page-header__description entry-content">
								<?php the_content(); ?>
							</div>
						<?php endif; ?>
					</header>
				<?php endwhile; ?>

				<?php if ( ! empty( $categories ) ) : ?>
					<ul class="taxonomy-list">
						<?php foreach ( $categories as $category ) : ?>
							<li class="taxonomy-list__item">
								<a class="taxonomy-list__link" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
									<span class="taxonomy-list__name"><?php echo esc_html( $category->name ); ?></span>
									<span class="taxonomy-list__count">
										<?php
										printf(
											/* translators: %d: number of posts */
											esc_html( _n( '%d post', '%d posts', $category->count, 'becoming-bipedal-theme' ) ),
											(int) $category->count
										);
										?>
									</span>
								</a>
								<?php if ( $category->description ) : ?>
									<p class="taxonomy-list__description"><?php echo esc_html( $category->description ); ?></p>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p><?php esc_html_e( 'No categories found.', 'becoming-bipedal-theme' ); ?></p>
				<?php endif; ?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php
get_footer();
