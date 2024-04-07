<?php
/**
 * Class Header Settings
 *
 * This class handles the settings for the WpKitElementor plugin.
 */

namespace WpKitElementor\Includes\Settings;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Core\Responsive\Responsive;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Header_Settings extends Tab_Base {
	public function get_id() {
		return 'wpkit-elementor-header-settings';
	}

	public function get_title() {
		return esc_html__( 'Site Header', 'wp-kit-elementor' );
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'wpkit_elementor_header_section',
			[
				'tab'   => 'wpkit-elementor-header-settings',
				'label' => esc_html__( 'Header', 'wp-kit-elementor' ),
			]
		);

		$this->add_control(
			'wpkit_elementor_header_logo_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Site Logo', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_tagline_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Tagline', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_menu_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Menu', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Search', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_display_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
				/* translators: %s: Link that opens the theme settings page. */
					__( 'Note: Hiding all the elements, only hides them visually. To disable them completely go to <a href="%s">Theme Settings</a>.', 'wp-kit-elementor' ),
					admin_url( 'themes.php?page=wpkit-elementor-settings' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [
					'wpkit_elementor_header_logo_display'    => '',
					'wpkit_elementor_header_tagline_display' => '',
					'wpkit_elementor_header_menu_display'    => '',
					'wpkit_elementor_header_search_display'  => ''
				]
			]
		);

		$this->add_control(
			'wpkit_elementor_header_layout',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Layout', 'wp-kit-elementor' ),
				'options'   => [
					'default'  => esc_html__( 'Default', 'wp-kit-elementor' ),
					'inverted' => esc_html__( 'Inverted', 'wp-kit-elementor' ),
					'centered' => esc_html__( 'Centered', 'wp-kit-elementor' ),
				],
				'selector'  => '.site-header',
				'default'   => 'default',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_position',
			[
				'type'     => Controls_Manager::SELECT,
				'label'    => esc_html__( 'Position', 'wp-kit-elementor' ),
				'options'  => [
					'default' => esc_html__( 'Default', 'wp-kit-elementor' ),
					'sticky'  => esc_html__( 'Sticky', 'wp-kit-elementor' ),
				],
				'selector' => '.site-header',
				'default'  => 'default',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_width',
			[
				'type'     => Controls_Manager::SELECT,
				'label'    => esc_html__( 'Width', 'wp-kit-elementor' ),
				'options'  => [
					'boxed'      => esc_html__( 'Boxed', 'wp-kit-elementor' ),
					'full-width' => esc_html__( 'Full Width', 'wp-kit-elementor' ),
				],
				'selector' => '.site-header',
				'default'  => 'boxed',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_custom_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Width', 'wp-kit-elementor' ),
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px'  => [
						'max' => 1600,
					],
					'em'  => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'condition'  => [
					'wpkit_elementor_header_width' => 'boxed',
				],
				'selectors'  => [
					'.site-header .header-inside' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;'
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_gap',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gap', 'wp-kit-elementor' ),
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px'  => [
						'max' => 100,
					],
					'em'  => [
						'max' => 5,
					],
					'rem' => [
						'max' => 5,
					],
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_layout',
							'operator' => '!=',
							'value'    => 'centered'
						]
					],
				],
				'selectors'  => [
					'.site-header' => 'padding-inline-end: {{SIZE}}{{UNIT}}; padding-inline-start: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'wpkit_elementor_header_background',
				'label'    => esc_html__( 'Background', 'wp-kit-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '.site-header',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpkit_elementor_header_logo_section',
			[
				'tab'        => 'wpkit-elementor-header-settings',
				'label'      => esc_html__( 'Site Logo', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_logo_display',
							'operator' => '=',
							'value'    => 'yes'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_logo_type',
			[
				'type'               => Controls_Manager::SELECT,
				'label'              => esc_html__( 'Type', 'wp-kit-elementor' ),
				'options'            => [
					'logo'  => esc_html__( 'Logo', 'wp-kit-elementor' ),
					'title' => esc_html__( 'Title', 'wp-kit-elementor' ),
				],
				'default'            => ( has_custom_logo() ? 'logo' : 'title' ),
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'wpkit_elementor_header_logo_width',
			[
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Logo Width', 'wp-kit-elementor' ),
				'size_units'  => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'description' => sprintf(
				/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'wp-kit-elementor' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'range'       => [
					'px'  => [
						'max' => 1000,
					],
					'em'  => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'condition'   => [
					'wpkit_elementor_header_logo_display' => 'yes',
					'wpkit_elementor_header_logo_type'    => 'logo'
				],
				'selectors'   => [
					'.site-header .site-branding .site-logo' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_logo_display' => 'yes',
					'wpkit_elementor_header_logo_type'    => 'title'
				],
				'selectors' => [
					'.site-header h1.site-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'wpkit_elementor_header_title_typography',
				'label'     => esc_html__( 'Typography', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_logo_display' => 'yes',
					'wpkit_elementor_header_logo_type'    => 'title'
				],
				'selector'  => '.site-header h1.site-title',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_title_link',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
				/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'wp-kit-elementor' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'condition'       => [
					'wpkit_elementor_header_logo_display' => 'yes',
					'wpkit_elementor_header_logo_type'    => 'title'
				],
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpkit_elementor_header_tagline_section',
			[
				'tab'        => 'wpkit-elementor-header-settings',
				'label'      => esc_html__( 'Tagline', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_tagline_display',
							'operator' => '=',
							'value'    => 'yes'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_tagline_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-header .site-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'wpkit_elementor_header_tagline_typography',
				'label'     => esc_html__( 'Typography', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_tagline_display' => 'yes',
				],
				'selector'  => '.site-header .site-description',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_tagline_link',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
				/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'wp-kit-elementor' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'condition'       => [
					'wpkit_elementor_header_tagline_display' => 'yes',
				],
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpkit_elementor_header_menu_section',
			[
				'tab'        => 'wpkit-elementor-header-settings',
				'label'      => esc_html__( 'Menu', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_menu_display',
							'operator' => '=',
							'value'    => 'yes'
						]
					],
				],
			]
		);

		$get_available_menus = wp_get_nav_menus();

		$menus = [ '0' => esc_html__( '— Select a Menu —', 'wp-kit-elementor' ) ];

		foreach ( $get_available_menus as $available_menu ) {
			$menus[ $available_menu->term_id ] = $available_menu->name;
		}

		if ( 1 === count( $menus ) ) {
			$this->add_control(
				'wpkit_elementor_header_menu_notice',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => '<strong>' . esc_html__( 'There are no menus in your site.', 'wp-kit-elementor' ) . '</strong>',
					'separator'       => 'after',
					'content_classes' => 'elementor-control-field-description',
				]
			);
		} else {
			$this->add_control(
				'wpkit_elementor_header_menu',
				[
					'type'        => Controls_Manager::SELECT,
					'label'       => esc_html__( 'Menu', 'wp-kit-elementor' ),
					'options'     => $menus,
					'default'     => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to <a href="%s" target="_blank">Menu screen</a> to manage your site\'s logo', 'wp-kit-elementor' ), admin_url( 'nav-menus.php' ) )
				]
			);

			$this->add_control(
				'wpkit_elementor_header_menu_notice',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => esc_html__( 'Change will be reflected in the in the preview only after the page reloads.', 'wp-kit-elementor' ),
					'content_classes' => 'elementor-control-field-description',
				]
			);

			$this->add_control(
				'wpkit_elementor_header_menu_layout',
				[
					'type'               => Controls_Manager::SELECT,
					'label'              => esc_html__( 'Menu Layout', 'wp-kit-elementor' ),
					'default'            => 'horizontal',
					'options'            => [
						'horizontal' => esc_html__( 'Horizontal', 'wp-kit-elementor' ),
						'dropdown'   => esc_html__( 'Dropdown', 'wp-kit-elementor' ),
					],
					'frontend_available' => true
				]
			);

			$breakpoints = Responsive::get_breakpoints();

			$this->add_control(
				'wpkit_elementor_header_menu_dropdown',
				[
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Breakpoints', 'wp-kit-elementor' ),
					'default'   => 'tablet',
					'options'   => [
						'mobile' => sprintf( esc_html__( 'Mobile (< %dpx)', 'wp-kit-elementor' ), $breakpoints['md'] ),
						'tablet' => sprintf( esc_html__( 'Tablet (< %dpx)', 'wp-kit-elementor' ), $breakpoints['lg'] ),
						'none'   => esc_html__( 'None', 'wp-kit-elementor' ),
					],
					'selector'  => '.site-header',
					'condition' => [
						'wpkit_elementor_header_menu_layout!' => 'dropdown'
					]
				]
			);
		}

		$this->add_control(
			'wpkit_elementor_header_menu_hamburgers',
			[
				'type'               => Controls_Manager::SELECT,
				'label'              => esc_html__( 'Type', 'wp-kit-elementor' ),
				'default'            => 'collapse',
				'options'            => [
					'slider'    => esc_html__( 'Slider', 'wp-kit-elementor' ),
					'squeeze'   => esc_html__( 'Squeeze', 'wp-kit-elementor' ),
					'arrow'     => esc_html__( 'Arrow', 'wp-kit-elementor' ),
					'arrowalt'  => esc_html__( 'Arrow Alt', 'wp-kit-elementor' ),
					'arrowturn' => esc_html__( 'Arrow Turn', 'wp-kit-elementor' ),
					'spin'      => esc_html__( 'Spin', 'wp-kit-elementor' ),
					'elastic'   => esc_html__( 'Elastic', 'wp-kit-elementor' ),
					'emphatic'  => esc_html__( 'Emphatic', 'wp-kit-elementor' ),
					'collapse'  => esc_html__( 'Collapse', 'wp-kit-elementor' ),
					'vortex'    => esc_html__( 'Vortex', 'wp-kit-elementor' ),
					'stand'     => esc_html__( 'Stand', 'wp-kit-elementor' ),
					'spring'    => esc_html__( 'Spring', 'wp-kit-elementor' ),
					'3dx'       => esc_html__( '3DX', 'wp-kit-elementor' ),
					'3dy'       => esc_html__( '3DY', 'wp-kit-elementor' ),
					'3dxy'      => esc_html__( '3DXY', 'wp-kit-elementor' ),
					'boring'    => esc_html__( 'Boring', 'wp-kit-elementor' ),
				],
				'conditions'         => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_menu_layout',
							'operator' => '=',
							'value'    => 'dropdown'
						],
						[
							'name'     => 'wpkit_elementor_header_menu_dropdown',
							'operator' => '!=',
							'value'    => 'none'
						]
					],
				],
				'frontend_available' => true
			]
		);

		$this->add_control(
			'wpkit_elementor_header_menu_hamburger_points',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Points Height', 'wp-kit-elementor' ),
				'range'      => [
					'px' => [
						'max' => 6,
					],
				],
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_menu_layout',
							'operator' => '=',
							'value'    => 'dropdown'
						],
						[
							'name'     => 'wpkit_elementor_header_menu_dropdown',
							'operator' => '!=',
							'value'    => 'none'
						]
					],
				],
				'selectors'  => [
					'.hamburger-inner'        => 'height: {{SIZE}}px;',
					'.hamburger-inner:before' => 'height: {{SIZE}}px;',
					'.hamburger-inner:after'  => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_menu_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_menu_display' => 'yes'
				],
				'selectors' => [
					'.site-header .site-navigation ul.menu li a' => 'color:{{VALUE}};'
				]
			]
		);

		$this->add_control(
			'wpkit_elementor_header_menu_toggle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Toggle Color', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_menu_display' => 'yes'
				],
				'selectors' => [
					'.site-header .site-navigation-toggle' => 'color:{{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'wpkit_elementor_header_menu_typography',
				'label'     => esc_html__( 'Typography', 'wp-kit-elementor' ),
				'condition' => [
					'wpkit_elementor_header_menu_display' => 'yes',
				],
				'selector'  => '.site-header .site-navigation ul.menu li',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpkit_elementor_header_search_section',
			[
				'tab'        => 'wpkit-elementor-header-settings',
				'label'      => esc_html__( 'Search', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_skin',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Skin', 'wp-kit-elementor' ),
				'default'   => 'classic',
				'options'   => [
					'classic'     => esc_html__( 'Classic', 'wp-kit-elementor' ),
					'minimal'     => esc_html__( 'Minimal', 'wp-kit-elementor' ),
					'full_screen' => esc_html__( 'Full Screen (Beta)', 'wp-kit-elementor' ),
				],
				'condition' => [
					'wpkit_elementor_header_search_display' => 'yes',
				]
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_toggle_size',
			[
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Toggle Size', 'wp-kit-elementor' ),
				'default'   => [
					'size' => 24
				],
				'range'     => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'wpkit_elementor_header_search_display' => 'yes',
				],
				'selectors' => [
					'.site-header .header-search-toggle-container .search-form__toggle'                          => '--e-wpkit-header-search--toggle-size: {{SIZE}}{{UNIT}};',
					'.site-header .header-search-toggle-container .search-form__toggle .font-icon-svg-container' => '--e-wpkit-header-search--toggle-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_placeholder',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Placeholder', 'wp-kit-elementor' ),
				'label_block' => true,
				'default'     => esc_attr__( 'Search...', 'wp-kit-elementor' ),
				'separator'   => 'before',
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'wpkit_elementor_header_search_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_heading_head',
			[
				'type'       => Controls_Manager::HEADING,
				'separator'  => 'before',
				'label'      => esc_html__( 'Heading', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_heading_text',
			[
				'type'        => Controls_Manager::TEXTAREA,
				'label'       => esc_html__( 'Heading', 'wp-kit-elementor' ),
				'label_block' => true,
				'default'     => esc_attr__( 'What are you looking for?', 'wp-kit-elementor' ),
				'dynamic'     => [
					'active' => true,
				],
				'conditions'  => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_heading_color',
			[
				'label'      => esc_html__( 'Color', 'wp-kit-elementor' ),
				'type'       => Controls_Manager::COLOR,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selectors'  => [
					'.search-overlay .search-form__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'       => 'wpkit_elementor_header_search_full_screen_heading_typography',
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selector'   => '.search-overlay .search-form__title',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_button_head',
			[
				'type'       => Controls_Manager::HEADING,
				'separator'  => 'before',
				'label'      => esc_html__( 'Button', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_submit_color',
			[
				'label'      => esc_html__( 'Color', 'wp-kit-elementor' ),
				'type'       => Controls_Manager::COLOR,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selectors'  => [
					'.search-overlay .search-form .search-submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_submit_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Size', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selectors'  => [
					'.search-overlay .search-form .search-field'  => '--e-wpkit-search-full-screen--field-height: {{SIZE}}{{UNIT}}; --e-wpkit-search-full-screen--field-pe: {{SIZE}}{{UNIT}};',
					'.search-overlay .search-form .search-submit' => '--e-wpkit-search-full-screen--submit-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_overlay_head',
			[
				'type'       => Controls_Manager::HEADING,
				'separator'  => 'before',
				'label'      => esc_html__( 'Overlay', 'wp-kit-elementor' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_full_screen_container_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Container Width', 'wp-kit-elementor' ),
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px'  => [
						'max' => 1600,
					],
					'em'  => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selectors'  => [
					'.search-overlay .container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'       => 'wpkit_elementor_header_search_full_screen_overlay_background',
				'types'      => [ 'classic', 'gradient' ],
				'exclude'    => [ 'image' ],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_search_display',
							'operator' => '=',
							'value'    => 'yes'
						],
						[
							'name'     => 'wpkit_elementor_header_search_skin',
							'operator' => '=',
							'value'    => 'full_screen'
						]
					],
				],
				'selector'   => '.search-overlay',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save change header menu to the WP settings
		if ( isset( $data['settings']['wpkit_elementor_header_menu'] ) ) {
			$menu_id              = $data['settings']['wpkit_elementor_header_menu'];
			$locations            = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = (int) $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	public function get_additional_tab_content() {

	}
}
