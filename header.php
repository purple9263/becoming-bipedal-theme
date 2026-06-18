<?php
/**
 * Header.
 *
 * @package Becoming_Bipedal_Theme
 */

if ( ! class_exists( 'Becoming_Bipedal_Nav_Walker' ) ) {
	class Becoming_Bipedal_Nav_Walker extends Walker_Nav_Menu {
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = implode( ' ', array_map( 'sanitize_html_class', array_filter( $classes ) ) );
			$output     .= '<li class="' . esc_attr( $class_names ) . '">';
			$output     .= '<a href="' . esc_url( $item->url ) . '">';
			$output     .= '<span class="nav-link__ja">' . esc_html( $item->title ) . '</span>';
			if ( ! empty( $item->description ) ) {
				$output .= '<span class="nav-link__en">' . esc_html( $item->description ) . '</span>';
			}
			$output .= '</a></li>';
		}
	}
}

$header_announcement = apply_filters( 'becoming_bipedal_header_announcement', 'AIとWeb制作を使って、在宅で働く力を作っている実践記録ブログです。
ChatGPT活用、AI副業、ブログ運営、制作まわりの試行錯誤を、初心者目線でリアルに書いています。' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site">
	<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'becoming-bipedal-theme' ); ?></a>

	<header class="site-header" role="banner">
		<div class="site-container site-header__inner">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<?php if ( is_front_page() && ! is_paged() ) : ?>
						<h1 class="site-branding__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="site-branding__title-strong">Becoming</span><span class="site-branding__title-light">Bipedal</span></a></h1>
					<?php else : ?>
						<p class="site-branding__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="site-branding__title-strong">Becoming</span><span class="site-branding__title-light">Bipedal</span></a></p>
					<?php endif; ?>
				<?php endif; ?>
				<p class="site-branding__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'AIとWeb制作で、在宅で働く力を作る実践メディア。' ); ?></p>
			</div>

			<div class="site-header__right">
				<div class="site-header__right-zone" style="display: grid; grid-template-rows: 54px 1fr; height: 158px; width: 100%; box-sizing: border-box;">
					
					<div class="site-header__ticker-wrap" style="height: 54px; line-height: 54px; background-color: var(--color-lavender); border-bottom: 1px solid var(--color-text); overflow: hidden; width: 100%; box-sizing: border-box;">
						<div class="site-header__ticker-track" style="display: inline-block; white-space: nowrap; animation: ticker-animation 35s linear infinite; vertical-align: middle;">
							<span style="font-size: 14px; color: var(--color-text); padding-right: 50px; display: inline-block;"><?php echo esc_html( $header_announcement ); ?></span>
							<span style="font-size: 14px; color: var(--color-text); padding-right: 50px; display: inline-block;"><?php echo esc_html( $header_announcement ); ?></span>
						</div>
					</div>

					<div class="site-header__navigation-wrap" style="display: flex; align-items: center; justify-content: flex-end; padding: 0 24px; margin: 0; box-sizing: border-box;">
						<button class="menu-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false">
							<svg class="icon-menu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
								<line class="line-1" x1="3" y1="6" x2="21" y2="6"></line>
								<line class="line-2" x1="3" y1="12" x2="21" y2="12"></line>
								<line class="line-3" x1="3" y1="18" x2="21" y2="18"></line>
							</svg>
						</button>

						<nav id="primary-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary', 'becoming-bipedal-theme' ); ?>">
							<?php
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container'      => false,
										'menu_class'     => 'primary-navigation__list',
										'fallback_cb'    => false,
										'walker'         => new Becoming_Bipedal_Nav_Walker(),
									)
								);
							} else {
								?>
								<ul class="primary-navigation__list">
									<?php
									$categories = get_categories(
										array(
											'orderby'    => 'name',
											'order'      => 'ASC',
											'hide_empty' => true,
										)
									);

									$en_names_map = array(
										// Slugs mapping
										'build-in-public'  => 'Build in Public',
										'ai-web-creation'  => 'AI Web Creation',
										'work'             => 'Work',
										'side-notes'       => 'Side Notes',
										
										// Japanese names mapping
										'学習記録'         => 'Build in Public',
										'AIサイト制作'     => 'AI Web Creation',
										'働き方'           => 'Work',
										'雑記'             => 'Side Notes',
										'AIツール活用'     => 'Utilization of AI tools',
										'AI副業'           => 'AI side job',
										'在宅ワーク'       => 'Work from home',
									);

									if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
										foreach ( $categories as $category ) {
											if ( 'uncategorized' === $category->slug ) {
												continue;
											}

											$url     = get_category_link( $category->term_id );
											$ja_name = $category->name;

											if ( isset( $en_names_map[ $category->name ] ) ) {
												$en_name = $en_names_map[ $category->name ];
											} elseif ( isset( $en_names_map[ $category->slug ] ) ) {
												$en_name = $en_names_map[ $category->slug ];
											} elseif ( ! empty( $category->description ) && mb_strlen( $category->description ) < 30 ) {
												$en_name = $category->description;
											} else {
												$en_name = ucwords( str_replace( '-', ' ', $category->slug ) );
											}

											echo '<li>';
											echo '<a href="' . esc_url( $url ) . '">';
											echo '<span class="nav-link__ja">' . esc_html( $ja_name ) . '</span>';
											echo '<span class="nav-link__en">' . esc_html( $en_name ) . '</span>';
											echo '</a>';
											echo '</li>';
										}
									}
									?>
								</ul>
								<?php
							}
							?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
