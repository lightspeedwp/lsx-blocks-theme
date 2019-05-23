<?php
namespace lsx_blocks_theme\classes;

/**
 * This class loads the other classes and function files
 *
 * @package lsx-blocks-theme
 */
class Setup {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_blocks_theme\classes\Setup()
	 */
	protected static $instance = null;

	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_filter( 'embed_defaults', array( $this, 'embed_dimensions' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_blocks_theme\classes\Setup()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function setup() {
		/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on lsx_blocks_theme, use a find and replace
			* to change 'lsx_blocks_theme' to the name of your theme in all the template files.
			*/
		load_theme_textdomain( 'lsx_blocks_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
		add_theme_support( 'title-tag' );

		/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'lsx_blocks_theme' ),
			)
		);

		/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'lsx_blocks_theme_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		/**
		 * Add support for default block styles.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#default-block-styles
		 */
		add_theme_support( 'wp-block-styles' );
		/**
		 * Add support for wide aligments.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#wide-alignment
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Add support for block color palettes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-color-palettes
		 */
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Dusty orange', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-orange',
				'color' => '#ed8f5b',
			),
			array(
				'name'  => __( 'Dusty red', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-red',
				'color' => '#e36d60',
			),
			array(
				'name'  => __( 'Dusty wine', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-wine',
				'color' => '#9c4368',
			),
			array(
				'name'  => __( 'Dark sunset', 'lsx_blocks_theme' ),
				'slug'  => 'dark-sunset',
				'color' => '#33223b',
			),
			array(
				'name'  => __( 'Almost black', 'lsx_blocks_theme' ),
				'slug'  => 'almost-black',
				'color' => '#0a1c28',
			),
			array(
				'name'  => __( 'Dusty water', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-water',
				'color' => '#41848f',
			),
			array(
				'name'  => __( 'Dusty sky', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-sky',
				'color' => '#72a7a3',
			),
			array(
				'name'  => __( 'Dusty daylight', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-daylight',
				'color' => '#97c0b7',
			),
			array(
				'name'  => __( 'Dusty sun', 'lsx_blocks_theme' ),
				'slug'  => 'dusty-sun',
				'color' => '#eee9d1',
			),
		) );

		/**
		 * Optional: Disable custom colors in block color palettes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
		 *
		 * add_theme_support( 'disable-custom-colors' );
		 */

		/**
		 * Add support for font sizes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-font-sizes
		 */
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => __( 'small', 'lsx_blocks_theme' ),
				'shortName' => __( 'S', 'lsx_blocks_theme' ),
				'size'      => 16,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'regular', 'lsx_blocks_theme' ),
				'shortName' => __( 'M', 'lsx_blocks_theme' ),
				'size'      => 20,
				'slug'      => 'regular',
			),
			array(
				'name'      => __( 'large', 'lsx_blocks_theme' ),
				'shortName' => __( 'L', 'lsx_blocks_theme' ),
				'size'      => 36,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'larger', 'lsx_blocks_theme' ),
				'shortName' => __( 'XL', 'lsx_blocks_theme' ),
				'size'      => 48,
				'slug'      => 'larger',
			),
		) );

		/**
		 * Optional: Add AMP support.
		 *
		 * Add built-in support for the AMP plugin and specific AMP features.
		 * Control how the plugin, when activated, impacts the theme.
		 *
		 * @link https://wordpress.org/plugins/amp/
		 */
		add_theme_support( 'amp', array(
			'comments_live_list' => true,
		) );

	}

	/**
	 * Set the embed width in pixels, based on the theme's design and stylesheet.
	 *
	 * @param array $dimensions An array of embed width and height values in pixels (in that order).
	 * @return array
	 */
	public function embed_dimensions( array $dimensions ) {
		$dimensions['width'] = 720;
		return $dimensions;
	}
}
