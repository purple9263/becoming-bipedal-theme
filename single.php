<?php
/**
 * @package Becoming_Bipedal_Theme
 */

get_header();
?>

<main id="primary" class="site-main site-main--single">
	<?php
	while ( have_posts() ) :
		the_post();
		$cats = get_the_category();
		?>
		<article <?php post_class( 'article-single' ); ?>>
			<header class="article-single__header site-container">
				<div class="article-single__meta-row">
					<time class="article-single__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'Y/n/j' ) ); ?></time>
					<?php if ( ! empty( $cats ) ) : ?>
						<a class="pill-tag" href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a>
					<?php endif; ?>
				</div>
				<?php the_title( '<h1 class="article-single__title">', '</h1>' ); ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="article-single__featured">
					<?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="article-single__content site-container entry-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'becoming-bipedal-theme' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<?php if ( has_tag() ) : ?>
				<footer class="article-single__footer site-container">
					<p class="article-single__tags-label"><?php esc_html_e( 'タグ', 'becoming-bipedal-theme' ); ?></p>
					<ul class="pill-list">
						<?php foreach ( get_the_tags() as $tag ) : ?>
							<li class="pill-list__item">
								<a class="pill-tag" href="<?php echo esc_url( get_tag_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</footer>
			<?php endif; ?>
		</article>

		<?php get_template_part( 'template-parts/related', 'posts' ); ?>

		<nav class="article-single__nav site-container post-navigation" aria-label="<?php esc_attr_e( 'Post', 'becoming-bipedal-theme' ); ?>">
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="post-nav__label">' . esc_html__( 'Previous', 'becoming-bipedal-theme' ) . '</span><span class="post-nav__title">%title</span>',
					'next_text' => '<span class="post-nav__label">' . esc_html__( 'Next', 'becoming-bipedal-theme' ) . '</span><span class="post-nav__title">%title</span>',
				)
			);
			?>
		</nav>


	<?php endwhile; ?>
</main>

<?php
get_footer();
