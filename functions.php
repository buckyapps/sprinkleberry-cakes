<?php
/**
 * Sprinkle Berry Cakes Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sprinkleberry_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sprinkleberry' ),
		'footer'  => __( 'Footer Menu', 'sprinkleberry' ),
	) );
}
add_action( 'after_setup_theme', 'sprinkleberry_setup' );

function sprinkleberry_scripts() {
	// Google Fonts
	wp_enqueue_style(
		'sprinkleberry-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap',
		array(),
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'sprinkleberry-style',
		get_stylesheet_uri(),
		array( 'sprinkleberry-fonts' ),
		'1.7.8'
	);

	// Scroll animations JS
	wp_enqueue_script(
		'sprinkleberry-scroll',
		get_template_directory_uri() . '/assets/js/scroll.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/scroll.js' ),
		true
	);

	wp_enqueue_script(
		'instagram-embed',
		'https://www.instagram.com/embed.js',
		array(),
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sprinkleberry_scripts' );

require get_template_directory() . '/inc/orders.php';


/**
 * Create the three category pages and assign their templates.
 */
function sprinkleberry_ensure_pages() {
	$pages = array(
		array(
			'slug'     => 'artisan-cakes',
			'title'    => 'Artisan Cakes',
			'template' => 'page-artisan-cakes.php',
		),
		array(
			'slug'     => 'cupcakes',
			'title'    => 'Cupcakes',
			'template' => 'page-cupcakes.php',
		),
		array(
			'slug'     => 'desserts',
			'title'    => 'Desserts',
			'template' => 'page-desserts.php',
		),
		array(
			'slug'     => 'cheesecakes',
			'title'    => 'Cheesecakes',
			'template' => 'page-cheesecakes.php',
		),
		array(
			'slug'     => 'pies',
			'title'    => 'Pies',
			'template' => 'page-pies.php',
		),
		array(
			'slug'     => 'parfaits',
			'title'    => 'Parfaits',
			'template' => 'page-parfaits.php',
		),
		array(
			'slug'     => 'sweet-treats',
			'title'    => 'Sweet Treats',
			'template' => 'page-sweet-treats.php',
		),
		array(
			'slug'     => 'about',
			'title'    => 'About',
			'template' => 'page-about.php',
		),
	);

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( ! $existing ) {
			$id = wp_insert_post(
				array(
					'post_title'  => $page['title'],
					'post_name'   => $page['slug'],
					'post_status' => 'publish',
					'post_type'   => 'page',
					'post_content'=> '',
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_wp_page_template', $page['template'] );
			}
		} else {
			update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
		}
	}
}
add_action( 'init', 'sprinkleberry_ensure_pages' );

require get_template_directory() . '/inc/subscribers.php';
require get_template_directory() . '/inc/gallery-cpt.php';
require get_template_directory() . '/inc/seo.php';
