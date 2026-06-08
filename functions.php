<?php
/**
 * Becoming Bipedal Theme functions and definitions.
 *
 * @package Becoming_Bipedal_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BECOMING_BIPEDAL_THEME_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function becoming_bipedal_theme_setup() {
	load_theme_textdomain( 'becoming-bipedal-theme', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	set_post_thumbnail_size( 1200, 675, true );
	add_image_size( 'becoming-bipedal-card', 640, 360, true );
	add_image_size( 'becoming-bipedal-related', 400, 225, true );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'becoming-bipedal-theme' ),
			'footer'  => esc_html__( 'Footer Menu', 'becoming-bipedal-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'becoming_bipedal_theme_setup' );

/**
 * Set content width.
 */
function becoming_bipedal_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'becoming_bipedal_theme_content_width', 720 );
}
add_action( 'after_setup_theme', 'becoming_bipedal_theme_content_width', 0 );

/**
 * Register widget areas.
 */
function becoming_bipedal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'becoming-bipedal-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'becoming-bipedal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'becoming_bipedal_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function becoming_bipedal_theme_scripts() {
	wp_enqueue_style(
		'becoming-bipedal-theme',
		get_stylesheet_uri(),
		array(),
		BECOMING_BIPEDAL_THEME_VERSION
	);

	wp_enqueue_style(
		'becoming-bipedal-theme-main',
		get_template_directory_uri() . '/assets/css/style.css',
		array( 'becoming-bipedal-theme' ),
		BECOMING_BIPEDAL_THEME_VERSION
	);

	if ( is_front_page() ) {
		wp_enqueue_script(
			'lottie-player',
			'https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie_light.min.js',
			array(),
			'5.12.2',
			true
		);
	}

	wp_enqueue_script(
		'becoming-bipedal-theme-main',
		get_template_directory_uri() . '/assets/js/main.js',
		is_front_page() ? array( 'lottie-player' ) : array(),
		BECOMING_BIPEDAL_THEME_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'becoming_bipedal_theme_scripts' );

/**
 * Custom excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function becoming_bipedal_theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'becoming_bipedal_theme_excerpt_length' );

/**
 * Custom excerpt more string.
 *
 * @param string $more More string.
 * @return string
 */
function becoming_bipedal_theme_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'becoming_bipedal_theme_excerpt_more' );

/**
 * Get related posts by shared tags.
 *
 * @param int $post_id Post ID.
 * @param int $count   Number of posts.
 * @return WP_Post[]
 */
function becoming_bipedal_theme_get_related_posts( $post_id = 0, $count = 3 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$tags    = wp_get_post_tags( $post_id );

	if ( empty( $tags ) ) {
		return array();
	}

	$tag_ids = wp_list_pluck( $tags, 'term_id' );

	$query = new WP_Query(
		array(
			'tag__in'             => $tag_ids,
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => $count,
			'ignore_sticky_posts' => 1,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'no_found_rows'       => true,
		)
	);

	return $query->posts;
}

/**
 * Display post meta (date, author, categories).
 */
function becoming_bipedal_theme_post_meta() {
	$time = sprintf(
		'<time class="post-card__date" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf(
		'<span class="post-card__author"><a href="%1$s">%2$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);

	$categories = '';
	if ( has_category() ) {
		$categories = '<span class="post-card__categories">' . get_the_category_list( ', ' ) . '</span>';
	}

	echo '<div class="post-card__meta">' . $time . ' &middot; ' . $author; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	if ( $categories ) {
		echo ' &middot; ' . $categories; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</div>';
}

/**
 * Display pagination for archives.
 */
function becoming_bipedal_theme_posts_pagination() {
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => esc_html__( '&larr; Previous', 'becoming-bipedal-theme' ),
			'next_text' => esc_html__( 'Next &rarr;', 'becoming-bipedal-theme' ),
		)
	);
}

/**
 * Speed Optimization: Remove unnecessary scripts/styles and headers.
 */
function becoming_bipedal_theme_optimize_head() {
	// Disable default emojis script and styles
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove RSD, WLW Manifest, and Generator links
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'shortlink_header_metadata', 10 );
}
add_action( 'init', 'becoming_bipedal_theme_optimize_head' );

function becoming_bipedal_theme_optimize_scripts() {
	// Dequeue WP Embed script
	wp_deregister_script( 'wp-embed' );

	// Dequeue jQuery Migrate (keep main jQuery just in case plugins need it, but remove migrate)
	if ( ! is_admin() ) {
		global $wp_scripts;
		if ( isset( $wp_scripts->registered['jquery'] ) ) {
			$jquery_dependencies = $wp_scripts->registered['jquery']->deps;
			$wp_scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'becoming_bipedal_theme_optimize_scripts', 99 );
