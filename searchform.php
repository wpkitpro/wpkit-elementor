<?php

/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link    https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link    https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WpKitElementor
 * @since   WpKitElementor 2.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$wpkit_elementor_unique_id = wp_unique_id( 'search-form-' );

$wpkit_elementor_aria_label  = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
$wpkit_elementor_placeholder = ! empty( wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_placeholder' ) ) ? esc_attr( wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_placeholder' ) ) : esc_attr__( 'Search&hellip;', 'wp-kit-elementor' );
?>
<form
	role="form" <?php echo $wpkit_elementor_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above.?>
	method="get" class="search-form ajax-search" action="<?php echo esc_html( home_url( '/' ) ) ?>"
>
	<div class="search-form__container">
		<label class="screen-reader-text" for="<?php echo esc_attr( $wpkit_elementor_unique_id ) ?>"><?php _e( 'Search&hellip;', 'wp-kit-elementor' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
		<input type="search" id="<?php esc_attr( $wpkit_elementor_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" placeholder="<?php echo $wpkit_elementor_placeholder; // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?>" aria-label="<?php echo esc_attr__('Search&hellip', 'wp-kit-elementor'); ?>" name="s">
		<button type="submit" class="search-submit">
			<span class="font-icon-svg-container"><i class="fa-solid fa-magnifying-glass"></i></span>
			<span class="search-submit__text"><?php esc_html_e( 'Search', 'wp-kit-elementor' ); ?></span>
		</button>
	</div>
</form>
