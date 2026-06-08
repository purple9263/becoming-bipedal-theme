<?php
/**
 * Template part for displaying posts in archives.
 *
 * @package Becoming_Bipedal_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-card__thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'becoming-bipedal-card',
				array(
					'class' => 'post-card__thumbnail',
					'alt'   => the_title_attribute( array( 'echo' => false ) ),
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="post-card__body">
		<header class="post-card__header">
			<?php the_title( '<h2 class="post-card__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
			<?php becoming_bipedal_theme_post_meta(); ?>
		</header>

		<div class="post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<p class="post-card__more">
			<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'becoming-bipedal-theme' ); ?></a>
		</p>
	</div>
</article>
