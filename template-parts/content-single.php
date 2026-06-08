<?php
/**
 * Template part for displaying single posts.
 *
 * @package Becoming_Bipedal_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
	<header class="single-post__header">
		<?php the_title( '<h1 class="single-post__title">', '</h1>' ); ?>
		<div class="single-post__meta">
			<?php becoming_bipedal_theme_post_meta(); ?>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="single-post__featured">
			<?php
			the_post_thumbnail(
				'large',
				array(
					'alt' => the_title_attribute( array( 'echo' => false ) ),
				)
			);
			?>
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

	<footer class="single-post__footer">
		<?php if ( has_tag() ) : ?>
			<ul class="post-tags">
				<?php
				$tags = get_the_tags();
				if ( $tags ) {
					foreach ( $tags as $tag ) {
						printf(
							'<li class="post-tags__item"><a href="%1$s">%2$s</a></li>',
							esc_url( get_tag_link( $tag->term_id ) ),
							esc_html( $tag->name )
						);
					}
				}
				?>
			</ul>
		<?php endif; ?>
	</footer>
</article>
