<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lsx_blocks_theme
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php wp_print_styles( array( 'lsx_blocks_theme-sidebar', 'lsx_blocks_theme-widgets' ) ); ?>
<aside id="secondary" class="primary-sidebar widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
