<?php
/**
 * LSX Blocks Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lsx_blocks_theme
 */

/**
 * Load the core file
 */
require get_template_directory() . '/inc/class-core.php';
/**
 * Returns the theme instance
 *
 * @return object \lsx_blocks_theme\classes\Core()
 */
function lsx_blocks_theme() {
	return \lsx_blocks_theme\classes\Core::get_instance();
}
lsx_blocks_theme();
