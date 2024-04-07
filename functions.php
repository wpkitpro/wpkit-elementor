<?php
/**
 * Template functions and definitions
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WPKIT_ELEMENTOR_VERSION', '2.0.0-beta1' );

function wp_kit_elementor_setup() {
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title for us
	add_theme_support( 'title-tag' );

	// Custom Logo
	add_theme_support( 'custom-logo', [
		'height'      => 100,
		'width'       => 350,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	// Set the default content width.
	$GLOBALS['content_width'] = 960;

	// This theme uses wp_nav_menu() in one location
	register_nav_menus( array(
		'primary' => __( 'Primary', 'wp-kit-elementor' ),
		'footer'  => __( 'Footer', 'wp-kit-elementor' ),
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	) );

	/*
	 * Editor Style.
	 */
	add_editor_style( 'style-editor.css' );

	// Gutenberg Embeds
	add_theme_support( 'responsive-embeds' );

	add_theme_support( "post-thumbnails" );

	// Gutenberg Widget Images
	add_theme_support( 'align-wide' );

	// Setup WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {
		// WooCommerce in general.
		add_theme_support( 'woocommerce' );

		// zoom.
		add_theme_support( 'wc-product-gallery-zoom' );

		// lightbox.
		add_theme_support( 'wc-product-gallery-lightbox' );

		// slider.
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

add_action( 'after_setup_theme', 'wp_kit_elementor_setup' );

function wp_kit_elementor_scripts() {
	$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Fontawesome
	wp_enqueue_style( 'wpkit-elementor-fontawesome', get_template_directory_uri() . '/assets/libs/fontawesome/css/all' . $min_suffix . '.css', array(), '6.5.1' );
	wp_enqueue_script( 'wpkit-elementor-fontawesome', get_template_directory_uri() . '/assets/libs/fontawesome/js/all' . $min_suffix . '.js', array(), '6.5.1', true );

	// Theme Stylesheet
	wp_enqueue_style( 'wpkit-elementor-frontend', get_stylesheet_uri(), array(), WPKIT_ELEMENTOR_VERSION );

	// Comment reply link
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'wpkit-elementor-theme', get_stylesheet_directory_uri() . '/theme' . $min_suffix . '.css', array(), WPKIT_ELEMENTOR_VERSION );
}

add_action( 'wp_enqueue_scripts', 'wp_kit_elementor_scripts' );

/** Includes */
require get_template_directory() . '/includes/elementor-functions.php';
require get_template_directory() . '/includes/template-functions.php';
