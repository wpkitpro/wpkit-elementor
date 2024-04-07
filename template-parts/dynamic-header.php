<?php
/**
 * The template for displaying dynamic header.
 *
 * @package WpKitElementor
 * @since   WpKitElementor 2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_editor        = isset( $_GET['elementor-preview'] );
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description', 'display' );
$primary_nav_menu = wp_nav_menu( [
	'theme_location' => 'primary',
	'fallback_cb'    => false,
	'echo'           => false
] );
?>

<?php // print_r( wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_display' ) ) ?>
<?php if ( 'full_screen' === wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_skin' ) && ( wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_display' ) || $is_editor ) ): ?>
	<div class="search-overlay" aria-hidden="true">
		<div class="container search-form__wrapper">
			<div class="search-top">
				<h2 class="search-form__title">
					<?php echo wp_kses_post( wp_kit_elementor_get_settings( 'wpkit_elementor_header_search_full_screen_heading_text' ) ); ?>
				</h2>
				<div class="close-search"></div>
			</div>
			<?php echo get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

<header id="masthead"
		class="site-header site-header-dynamic <?php echo esc_attr( wp_kit_elementor_get_header_layout_classes() ) ?>"
		role="banner"
>
	<div class="header-inside">
		<div
			class="site-branding show-<?php echo wp_kit_elementor_get_settings( 'wpkit_elementor_header_logo_type' ); ?>">
			<?php if ( has_custom_logo() && ( 'logo' === wp_kit_elementor_get_settings( 'wpkit_elementor_header_logo_type' ) || $is_editor ) ): ?>
				<div
					class="site-logo <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_logo_display' ) ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif; ?>

			<?php if ( $blog_name && ( 'title' === wp_kit_elementor_get_settings( 'wpkit_elementor_header_logo_type' ) || $is_editor ) ): ?>
				<h1 class="site-title <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_logo_display' ) ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ) ?>"
					   title="<?php echo esc_html__( 'Home', 'wp-kit-elementor' ) ?>"
					   rel="home"
					>
						<?php echo esc_html( $blog_name ); ?>
					</a>
				</h1>
			<?php endif; ?>

			<?php if ( $blog_description && ( wp_kit_elementor_get_settings( 'wpkit_elementor_header_tagline_display' ) || $is_editor ) ): ?>
				<p class="site-description <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_tagline_display' ) ) ?>">
					<?php echo esc_html( $blog_description ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $primary_nav_menu && ( 'yes' === wp_kit_elementor_get_settings( 'wpkit_elementor_header_menu_display' ) || $is_editor ) ): ?>
			<nav
				class="site-navigation <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_menu_display' ) ); ?>">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $primary_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>

		<div class="header-section header-section-third">
			<div
				class="header-search-toggle-container <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_search_display' ) ); ?>">
				<div class="search-form__toggle" tabindex="0" aria-expanded="false" role="button">
					<div class="font-icon-svg-container">
						<i class="fa-solid fa-magnifying-glass"></i>
					</div>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'wp-kit-elementor' ); ?></span>
				</div>
			</div>

			<?php if ( $primary_nav_menu ): ?>
				<div
					class="site-navigation-toggle-container <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_menu_display' ) ); ?>">
					<div
						class="site-navigation-toggle hamburger--<?php echo esc_attr( wp_kit_elementor_get_settings( 'wpkit_elementor_header_menu_hamburgers' ) ); ?>"
						type="button"
						aria-expanded="false"
						role="button"
					>
						<span class="hamburger-box"><span class="hamburger-inner"></span></span>
						<span class="screen-reader-text"><?php echo esc_html__( 'Menu', 'wp-kit-elementor' ) ?></span>
					</div>
				</div>

				<nav
					class="site-navigation-dropdown <?php echo esc_attr( wp_kit_elementor_show_hide( 'wpkit_elementor_header_menu_display' ) ); ?>"
					aria-hidden="true"
				>
					<?php
					// PHPCS - escaped by WordPress with "wp_nav_menu"
					echo $primary_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</nav>
			<?php endif; ?>

		</div>

	</div>
</header>
