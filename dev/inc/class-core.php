<?php
namespace lsx_blocks_theme\classes;

/**
 * This class loads the other classes and function files
 *
 * @package lsx-blocks-theme
 */
class Core {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_blocks_theme\classes\Core()
	 */
	protected static $instance = null;

	/**
	 * @var object \lsx_blocks_theme\classes\Frontend();
	 */
	public $frontend;

	/**
	 * Contructor
	 */
	public function __construct() {
		$this->load_classes();
		$this->load_includes();
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
	 * Loads the variable classes and the static classes.
	 */
	private function load_classes() {
		require_once get_template_directory() . '/inc/class-frontend.php';
		$this->frontend = Frontend::get_instance();
	}
	/**
	 * Loads the plugin functions.
	 */
	private function load_includes() {
		/**
		 * Custom responsive image sizes.
		 */
		require get_template_directory() . '/inc/image-sizes.php';

		/**
		 * Implement the Custom Header feature.
		 */
		require get_template_directory() . '/pluggable/custom-header.php';

		/**
		 * Custom template tags for this theme.
		 */
		require get_template_directory() . '/inc/template-tags.php';

		/**
		 * Functions which enhance the theme by hooking into WordPress.
		 */
		require get_template_directory() . '/inc/template-functions.php';

		/**
		 * Customizer additions.
		 */
		require get_template_directory() . '/inc/customizer.php';

		/**
		 * Optional: Add theme support for lazyloading images.
		 *
		 * @link https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/
		 */
		require get_template_directory() . '/pluggable/lazyload/lazyload.php';
	}
}
