<?php
/**
 * Elementor Functions
 *
 * @package WpKitElementor
 */

use Elementor\Plugin;
use Elementor\Core\Kits\Documents\Kit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Initializes the settings for WPKitElementor.
 *
 * This method registers the header settings tab in the Elementor kit registration
 * if the wp_kit_elementor_display_header() function returns true.
 *
 * @return void
 * @since 1.0.0
 */
function wp_kit_elementor_settings_init() {
	require 'settings/class-settings-header.php';
	require 'settings/class-settings-footer.php';

	add_action( 'elementor/kit/register_tabs', function ( Kit $kit ) {
		if ( ! wp_kit_elementor_display_header() ) {
			return;
		}

		$kit->register_tab( 'wpkit-elementor-header-settings', WpKitElementor\Includes\Settings\Header_Settings::class );
		$kit->register_tab( 'wpkit-elementor-footer-settings', WpKitElementor\Includes\Settings\Footer_Settings::class );
	}, 1, 40 );
}

add_action( 'elementor/init', 'wp_kit_elementor_settings_init' );

if ( ! function_exists( 'wp_kit_elementor_display_header' ) ) {
	/**
	 * Sets the value of the wpkit_elementor_header variable to true and returns it after applying the 'wp_kit_elementor_header' filter.
	 *
	 * @return bool Returns the value of the wpkit_elementor_header variable after applying the 'wp_kit_elementor_header' filter.
	 */
	function wp_kit_elementor_display_header() {
		$wpkit_elementor_header = true;

		return apply_filters( 'wp_kit_elementor_header', $wpkit_elementor_header );
	}
}

if ( ! function_exists( 'wp_kit_elementor_get_settings' ) ) {
	/**
	 * Retrieves the value of a specific setting from the global $wp_kit_elementor_settings variable after applying a filter.
	 *
	 * @param   string  $setting_id  The ID of the setting to retrieve.
	 *
	 * @return mixed Returns the value of the specified setting after applying the 'wp_kit_elementor_{setting_id}' filter.
	 * @since 1.0.0
	 */
	function wp_kit_elementor_get_settings( $setting_id ) {
		global $wp_kit_elementor_settings;

		$setting = '';

		if ( ! isset( $wp_kit_elementor_settings['kit_settings'] ) ) {
			$get_kit = Plugin::$instance->kits_manager->get_active_kit();

			$wp_kit_elementor_settings['kit_settings'] = $get_kit->get_settings();
		}

		if ( isset( $wp_kit_elementor_settings['kit_settings'][ $setting_id ] ) ) {
			$setting = $wp_kit_elementor_settings['kit_settings'][ $setting_id ];
		}

		return apply_filters( 'wp_kit_elementor_' . $setting_id, $setting );
	}
}

/**
 * Returns either 'show' or 'hide' based on the value of the setting with the given $setting_id.
 *
 * @param   string  $setting_id  The ID of the setting to check.
 *
 * @return string Returns 'show' if the value of the setting is 'yes', otherwise returns 'hide'.
 */
function wp_kit_elementor_show_hide( $setting_id ) {
	return ( 'yes' === wp_kit_elementor_get_settings( $setting_id ) ? 'show' : 'hide' );
}


/**
 * Dynamic Header Classes
 */
if ( ! function_exists( 'wp_kit_elementor_get_header_layout_classes' ) ) {
	/**
	 * Returns a string of layout classes based on the value of the wpki_elementor_header_layout and wpki_elementor_header_width settings.
	 *
	 * @return string Returns a string of layout classes based on the value of the wpki_elementor_header_layout and wpki_elementor_header_width settings.
	 * @since 1.0.0
	 */
	function wp_kit_elementor_get_header_layout_classes() {
		$layout_classes = [];

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_layout' );
		if ( $header_layout === 'inverted' ) {
			$layout_classes[] = 'header-inverted';
		} elseif ( $header_layout === 'centered' ) {
			$layout_classes[] = 'header-centered';
		}

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_position' );
		if ( $header_layout === 'sticky' ) {
			$layout_classes[] = 'header-sticky';
		}

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_width' );
		if ( $header_layout === 'full-width' ) {
			$layout_classes[] = 'header-full-width';
		}

		$header_menu_dropdown = wp_kit_elementor_get_settings( 'wpkit_elementor_header_menu_dropdown' );
		if ( 'tablet' === $header_menu_dropdown ) {
			$layout_classes[] = 'menu-dropdown-tablet';
		} elseif ( 'mobile' === $header_menu_dropdown ) {
			$layout_classes[] = 'menu-dropdown-mobile';
		} elseif ( 'none' === $header_menu_dropdown ) {
			$layout_classes[] = 'menu-dropdown-none';
		}

		$header_search_skin = wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_skin' );
		if ( 'classic' === $header_search_skin ) {
			$layout_classes[] = 'header-search-form--skin-classic';
		} elseif ( 'minimal' === $header_search_skin ) {
			$layout_classes[] = 'header-search-form--skin-minimal';
		} elseif ( 'full_screen' === $header_search_skin ) {
			$layout_classes[] = 'header-search-form--skin-full_screen';
		}

		$wpkit_elementor_header_menu_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_menu_layout' );
		if ( 'dropdown' === $wpkit_elementor_header_menu_layout ) {
			$layout_classes[] = 'menu-layout-dropdown';
		}

		$wpkit_elementor_header_search_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_display' );
		if ( 'yes' === $wpkit_elementor_header_search_layout ) {
			$layout_classes[] = 'header-search-form';
		}

		return implode( ' ', $layout_classes );
	}
}

if ( ! function_exists( 'wp_kit_elementor_header_search_form' ) ) {
	function wp_kit_elementor_header_search_form() {
		$header_search_skin = wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_skin' );

		echo get_search_form();
		// echo 'search form';
	}
}


add_action( 'wp_enqueue_scripts', function () {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'wpkit-elementor-frontend', get_template_directory_uri() . '/assets/js/wpkit-elementor-frontend.js', WPKIT_ELEMENTOR_VERSION, true );

	Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
} );
