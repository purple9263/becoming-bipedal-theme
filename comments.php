<?php
/**
 * Comments template.
 *
 * @package Becoming_Bipedal_Theme
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			printf(
				/* translators: 1: comment count */
				esc_html( _n( '%1$s Comment', '%1$s Comments', $comment_count, 'becoming-bipedal-theme' ) ),
				number_format_i18n( $comment_count )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Older comments', 'becoming-bipedal-theme' ),
				'next_text' => esc_html__( 'Newer comments', 'becoming-bipedal-theme' ),
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'becoming-bipedal-theme' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply' => esc_html__( 'Leave a Comment', 'becoming-bipedal-theme' ),
		)
	);
	?>
</div>
