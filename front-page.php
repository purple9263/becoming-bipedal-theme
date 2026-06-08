<?php
/**
 * Front page — Studio-like magazine layout.
 *
 * @package Becoming_Bipedal_Theme
 */

get_header();

$paged      = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$list_query = new WP_Query(
	array(
		'posts_per_page'      => 4,
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
	)
);

$is_new_days = (int) apply_filters( 'becoming_bipedal_new_post_days', 14 );
?>

<main id="primary" class="site-main site-main--front">
	<?php if ( 1 === $paged ) : ?>
		<section class="front-hero">
			<div class="front-hero__wrapper">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/img_0.jpg' ); ?>" 
				     srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/img_0-mobile.jpg' ); ?> 800w, <?php echo esc_url( get_template_directory_uri() . '/assets/images/img_0.jpg' ); ?> 1024w"
				     sizes="(max-width: 767px) 100vw, 1024px"
				     class="front-hero__bg-img" 
				     alt="First View Background" 
				     fetchpriority="high" 
				     loading="eager" 
				     decoding="async">
				<div id="lottie-fv" class="front-hero__lottie" 
					data-json-path="<?php echo esc_url( get_template_directory_uri() . '/assets/js/BB_FV.json' ); ?>"
					data-assets-path="<?php echo esc_url( get_template_directory_uri() . '/assets/' ); ?>"></div>
			</div>
		</section>
	<?php endif; ?>

	<section class="magazine-feed">
		<div class="site-container">
			<?php if ( $list_query->have_posts() ) : ?>
				<div class="magazine-feed__list">
					<?php
					while ( $list_query->have_posts() ) :
						$list_query->the_post();
						$cats   = get_the_category();
						$is_new = ( time() - get_post_time( 'U', true ) ) < ( $is_new_days * DAY_IN_SECONDS );
						?>
						<article <?php post_class( 'magazine-item' ); ?>>
							<a class="magazine-item__link" href="<?php the_permalink(); ?>">
								<div class="magazine-item__body">
									<p class="magazine-item__meta">
										<?php if ( $is_new ) : ?>
											<em class="magazine-item__new">NEW</em>
										<?php endif; ?>
										<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'Y/n/j' ) ); ?></time>
									</p>
									<h2 class="magazine-item__title"><?php the_title(); ?></h2>
									<?php if ( ! empty( $cats ) ) : ?>
										<div class="magazine-item__cats">
											<?php foreach ( $cats as $cat ) : ?>
												<span class="pill-tag"><?php echo esc_html( $cat->name ); ?></span>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="magazine-item__thumb-wrap">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'becoming-bipedal-card', array( 'class' => 'magazine-item__thumb', 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
									<?php else : ?>
										<span class="magazine-item__thumb magazine-item__thumb--empty" aria-hidden="true"></span>
									<?php endif; ?>
								</div>
							</a>
						</article>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p class="no-results"><?php esc_html_e( 'No posts found.', 'becoming-bipedal-theme' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
wp_reset_postdata();
get_footer();
