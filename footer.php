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
		array(
			'label' => 'Instagram',
			'url'   => 'https://www.instagram.com/purple_9263/',
			'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>',
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
				<p class="site-footer__tagline">むらさき丸は二足歩行で歩きたい</p>

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
