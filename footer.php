<?php
/**
 * Footer.
 *
 * @package Becoming_Bipedal_Theme
 */

$categories = get_categories(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	)
);

$tags = get_tags(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
	)
);

if ( empty( $tags ) || is_wp_error( $tags ) ) {
	$tags = array();
	$dummy_tags = array( 'AI', 'ChatGPT', 'WordPress', 'STUDIO', '生活', 'ブログ', '二足歩行', 'デザイン' );
	foreach ( $dummy_tags as $idx => $tag_name ) {
		$tags[] = (object) array(
			'term_id' => 0,
			'name'    => $tag_name,
			'slug'    => 'dummy-' . $idx,
		);
	}
}

$social_links = apply_filters(
	'becoming_bipedal_social_links',
	array(
		array(
			'label' => 'X（旧Twitter）',
			'url'   => 'https://x.com/purple_9263',
			'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.262 5.635L18.244 2.25Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>',
		),
	)
);

$privacy_url = get_privacy_policy_url();
?>

	<footer class="site-footer" role="contentinfo">
		<div class="site-footer__discover">
			<div class="site-container">
				<?php if ( ! empty( $categories ) ) : ?>
					<div class="site-footer__discover-row">
						<p class="site-footer__discover-label"><?php esc_html_e( 'カテゴリーから探す', 'becoming-bipedal-theme' ); ?></p>
						<ul class="pill-list pill-list--discover">
							<?php foreach ( $categories as $category ) : ?>
								<li><a class="pill-tag pill-tag--discover" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $tags ) ) : ?>
					<div class="site-footer__discover-row">
						<p class="site-footer__discover-label"><?php esc_html_e( 'タグから探す', 'becoming-bipedal-theme' ); ?></p>
						<ul class="pill-list pill-list--discover">
							<?php foreach ( $tags as $tag ) : ?>
								<li><a class="pill-tag pill-tag--discover" href="<?php echo esc_url( $tag->term_id ? get_tag_link( $tag->term_id ) : '#' ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="site-footer__brand">
			<div class="site-container site-footer__brand-inner">
				<p class="site-footer__site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Becoming</span><span>Bipedal</span></a></p>
				<p class="site-footer__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'AIとWeb制作で、在宅で働く力を作る実践メディア。' ); ?></p>

				<?php if ( ! empty( $social_links ) ) : ?>
					<ul class="site-footer__social">
						<?php foreach ( $social_links as $link ) : ?>
							<?php if ( empty( $link['url'] ) || empty( $link['svg'] ) ) { continue; } ?>
							<li>
								<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $link['label'] ); ?>">
									<?php echo wp_kses( $link['svg'], array(
										'svg'  => array( 'xmlns' => true, 'width' => true, 'height' => true, 'viewBox' => true, 'fill' => true, 'aria-hidden' => true ),
										'path' => array( 'd' => true ),
									) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<div class="site-footer__bottom">
			<div class="site-container site-footer__bottom-inner">
				<p class="site-footer__copyright">&copy;Becoming Bipedal <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
				<?php if ( $privacy_url ) : ?>
					<p class="site-footer__privacy"><a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'プライバシーポリシー', 'becoming-bipedal-theme' ); ?></a></p>
				<?php endif; ?>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
