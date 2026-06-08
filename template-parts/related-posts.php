<?php
/**
 * Template part for related posts (same tags).
 *
 * @package Becoming_Bipedal_Theme
 */

$related_posts = becoming_bipedal_theme_get_related_posts( get_the_ID(), 3 );

if ( empty( $related_posts ) ) {
	return;
}
?>

<section class="related-posts" aria-labelledby="related-posts-title">
	<h2 id="related-posts-title" class="related-posts__title">
		<?php esc_html_e( '関連記事', 'becoming-bipedal-theme' ); ?>
	</h2>

	<ul class="related-posts__list">
		<?php foreach ( $related_posts as $related_post ) : ?>
			<li class="related-posts__item">
				<a class="related-posts__link" href="<?php echo esc_url( get_permalink( $related_post ) ); ?>">
					<?php if ( has_post_thumbnail( $related_post ) ) : ?>
						<?php
						echo get_the_post_thumbnail(
							$related_post,
							'becoming-bipedal-related',
							array(
								'class' => 'related-posts__thumb',
								'alt'   => esc_attr( get_the_title( $related_post ) ),
							)
						);
						?>
					<?php else : ?>
						<div class="related-posts__thumb" aria-hidden="true"></div>
					<?php endif; ?>
					<div class="related-posts__body">
						<p class="related-posts__name"><?php echo esc_html( get_the_title( $related_post ) ); ?></p>
					</div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
