<?php
namespace lsx_blocks_theme\classes;

/**
 * This class loads the other classes and function files
 *
 * @package lsx-blocks-theme
 */
class Frontend {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_blocks_theme\classes\Frontend()
	 */
	protected static $instance = null;

	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		add_filter( 'wp_resource_hints', array( $this, 'resource_hints' ), 10, 2 );	
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_blocks_theme\classes\Core()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Enqueue styles.
	 */
	public function styles() {
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'lsx_blocks_theme-fonts', $this->fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Enqueue main stylesheet.
		wp_enqueue_style( 'lsx_blocks_theme-base-style', get_stylesheet_uri(), array(), '20180514' );

		wp_enqueue_style( 'lsx_blocks_theme-bootstrap', get_theme_file_uri( '/css/bootstrap.css' ), array(), '20180514' );

		// Register component styles that are printed as needed.
		wp_register_style( 'lsx_blocks_theme-comments', get_theme_file_uri( '/css/comments.css' ), array(), '20180514' );
		wp_register_style( 'lsx_blocks_theme-content', get_theme_file_uri( '/css/content.css' ), array(), '20180514' );
		wp_register_style( 'lsx_blocks_theme-sidebar', get_theme_file_uri( '/css/sidebar.css' ), array(), '20180514' );
		wp_register_style( 'lsx_blocks_theme-widgets', get_theme_file_uri( '/css/widgets.css' ), array(), '20180514' );
		wp_register_style( 'lsx_blocks_theme-front-page', get_theme_file_uri( '/css/front-page.css' ), array(), '20180514' );
	}
	/**
	 * Enqueue scripts.
	 */
	public function scripts() {

		// If the AMP plugin is active, return early.
		if ( lsx_blocks_theme_is_amp() ) {
			return;
		}

		// Enqueue all the global styles.
		wp_enqueue_script( 'lsx_blocks_theme-bootstrap' );

		// Enqueue the navigation script.
		wp_enqueue_script( 'lsx_blocks_theme-navigation', get_theme_file_uri( '/js/navigation.js' ), array(), '20180514', false );
		wp_script_add_data( 'lsx_blocks_theme-navigation', 'async', true );

		wp_localize_script(
			'lsx_blocks_theme-navigation',
			'lsx_blocks_themeScreenReaderText',
			array(
				'expand'   => __( 'Expand child menu', 'lsx_blocks_theme' ),
				'collapse' => __( 'Collapse child menu', 'lsx_blocks_theme' ),
			)
		);

		// Enqueue skip-link-focus script.
		wp_enqueue_script( 'lsx_blocks_theme-skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20180514', false );
		wp_script_add_data( 'lsx_blocks_theme-skip-link-focus-fix', 'defer', true );

		// Enqueue comment script on singular post/page views only.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Register Google Fonts
	 */
	public function fonts_url() {
		$fonts_url = '';

		/**
		 * Translator: If Roboto Sans does not support characters in your language, translate this to 'off'.
		 */
		$roboto = esc_html_x( 'on', 'Roboto Condensed font: on or off', 'lsx_blocks_theme' );
		/**
		 * Translator: If Crimson Text does not support characters in your language, translate this to 'off'.
		 */
		$crimson_text = esc_html_x( 'on', 'Crimson Text font: on or off', 'lsx_blocks_theme' );

		$font_families = array();

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto Condensed:400,400i,700,700i';
		}

		if ( 'off' !== $crimson_text ) {
			$font_families[] = 'Crimson Text:400,400i,600,600i';
		}

		if ( in_array( 'on', array( $roboto, $crimson_text ) ) ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );

	}

	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	public function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'lsx_blocks_theme-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}
}
