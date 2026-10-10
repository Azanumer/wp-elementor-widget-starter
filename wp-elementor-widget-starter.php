<?php
/**
 * Plugin Name:       Elementor Testimonial Widget (Starter)
 * Plugin URI:        https://github.com/Azanumer/wp-elementor-widget-starter
 * Description:       Boilerplate for a custom Elementor widget — a testimonial card with controls for text, avatar, rating, colors and layout. Duplicate it to build your own widgets.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Azan Umer
 * License:           MIT
 * Text Domain:       elementor-widget-starter
 */

defined('ABSPATH') || exit;

define('EWS_VERSION', '1.0.0');
define('EWS_PLUGIN_FILE', __FILE__);
define('EWS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EWS_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Boot only when Elementor is active and loaded.
 */
add_action('plugins_loaded', 'ews_boot');
function ews_boot() {
	if (!did_action('elementor/loaded')) {
		add_action('admin_notices', 'ews_missing_elementor_notice');
		return;
	}
	require_once EWS_PLUGIN_DIR . 'widgets/class-testimonial-card-widget.php';
	add_action('elementor/widgets/register', 'ews_register_widgets');
	add_action('elementor/frontend/after_register_styles', 'ews_register_styles');
	add_action('elementor/frontend/after_register_scripts', 'ews_register_scripts');
}

/**
 * Register our custom widget(s) with Elementor.
 */
function ews_register_widgets($widgets_manager) {
	$widgets_manager->register(new \EWS_Testimonial_Card_Widget());
}

/**
 * Front-end stylesheet for the widget.
 */
function ews_register_styles() {
	wp_register_style(
		'ews-widget',
		EWS_PLUGIN_URL . 'assets/css/widget.css',
		array(),
		EWS_VERSION
	);
}

/**
 * Editor/preview script for the widget (entrance animation).
 */
function ews_register_scripts() {
	wp_register_script(
		'ews-widget',
		EWS_PLUGIN_URL . 'assets/js/widget.js',
		array('jquery'),
		EWS_VERSION,
		true
	);
}

function ews_missing_elementor_notice() {
	if (current_user_can('activate_plugins')) {
		echo '<div class="notice notice-warning"><p><strong>Elementor Widget Starter</strong> needs Elementor installed and activated to work.</p></div>';
	}
}
