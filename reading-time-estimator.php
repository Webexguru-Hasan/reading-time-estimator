<?php 
/**
 * Plugin Name: Reading Time Estimator
 * Plugin URI: https://example.com/reading-time-estimator
 * Description: A simple plugin that shows estimated reading time for blog posts.
 * Version:     2.0
 * Author:      Hasan Wazid
 * Author URI:  https://example.com
 * License:     GPLv2 or later
 * Text Domain: reading-time-estimator
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin path
define( 'RTE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Include settings page
require_once RTE_PLUGIN_PATH . 'admin/settings-page.php';

// Add admin menu
function rte_add_admin_menu() {
    add_menu_page(
        'Reading Time Estimator',
        'Reading Time',
        'manage_options',
        'reading-time-estimator',
        'rte_settings_page',   // must match function name
        'dashicons-clock',
        6
    ); 
}
add_action('admin_menu', 'rte_add_admin_menu');

// Load CSS & JS
function rte_enqueue_assets($hook) {
    if ($hook !== 'toplevel_page_reading-time-estimator') return;

    wp_enqueue_style('rte-popup-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('rte-popup-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'rte_enqueue_assets');