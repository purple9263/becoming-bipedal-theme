<?php
/**
 * Post card for archives.
 *
 * @package Becoming_Bipedal_Theme
 */

$cats = get_the_category();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-card' ); ?>>
	<a class="archive-post-card__link" href="<?php the_permalink(); ?>">
		<div class="archive-post-card__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php
				the_post_thumbnail(
					'becoming-bipedal-card',
					array(
						'class' => 'archive-post-card__thumbnail',
						'alt'   => the_title_attribute( array( 'echo' => false ) ),
					)
				);
				?>
			<?php else : ?>
				<div class="archive-post-card__placeholder" aria-hidden="true"></div>
			<?php endif; ?>
		</div>

		<div class="archive-post-card__body">
			<h2 class="archive-post-card__title"><?php the_title(); ?></h2>
			<p class="archive-post-card__meta">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'Y/n/j' ) ); ?></time>
			</p>
			<?php if ( ! empty( $cats ) ) : ?>
				<div class="archive-post-card__cats">
					<span class="pill-tag"><?php echo esc_html( $cats[0]->name ); ?></span>
				</div>
			<?php endif; ?>
		</div>
	</a>
</article>
