<?php
/**
 * Plugin Name: Reading Time Estimator
 * Plugin URI:  https://github.com/your-username/reading-time-estimator
 * Description: A WordPress plugin that displays estimated reading time above posts with a customizable popup.
 * Version:     1.0.0
 * Author:      Hasan
 * Author URI:  https://your-portfolio-or-profile-link.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: reading-time-estimator
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ---- Constants ----
define( 'RTE_VERSION', '1.0.0' );
define( 'RTE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RTE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// ---- Includes ----
require_once RTE_PLUGIN_DIR . 'admin/settings-page.php';

// ---- Activation: set default welcome text ----
function rte_activate() {
    if ( false === get_option( 'rte_welcome_text', false ) ) {
        add_option(
            'rte_welcome_text',
            __( 'Welcome to Time Estimator Plugin!', 'reading-time-estimator' )
        );
    }
}
register_activation_hook( __FILE__, 'rte_activate' );

// ---- Deactivation: remove data as per your requirement ----
function rte_deactivate() {
    // NOTE: সাধারণত ডেটা uninstall-এ ডিলিট করা হয়।
    // তবে আপনার চাহিদা অনুযায়ী deactivation-এ মুছে দিচ্ছি:
    // delete_option( 'rte_welcome_text' );
}
register_deactivation_hook( __FILE__, 'rte_deactivate' );

// ---- Settings (Settings API) ----
function rte_register_settings() {
    register_setting(
        'rte_settings',              // settings group
        'rte_welcome_text',          // option name
        array(
            'type'              => 'string',
            'sanitize_callback' => 'wp_kses_post',
            'default'           => __( 'Welcome to Time Estimator Plugin!', 'reading-time-estimator' ),
        )
    );

    add_settings_section(
        'rte_main_section',
        __( 'General', 'reading-time-estimator' ),
        '__return_false',
        'reading-time-estimator'     // page slug (same as menu slug)
    );

    add_settings_field(
        'rte_welcome_text_field',
        __( 'Welcome text', 'reading-time-estimator' ),
        'rte_welcome_text_field_cb',
        'reading-time-estimator',    // page
        'rte_main_section'           // section
    );
}
add_action( 'admin_init', 'rte_register_settings' );

// Field renderer (textarea)
function rte_welcome_text_field_cb() {
    $value = get_option( 'rte_welcome_text', '' );
    echo '<textarea name="rte_welcome_text" rows="3" class="regular-text" style="width:100%;">'
        . esc_textarea( $value )
        . '</textarea>';
    echo '<p class="description">' .
        esc_html__( 'Shown on the frontend via the [rte_welcome] shortcode. Basic HTML allowed.', 'reading-time-estimator' ) .
        '</p>';
}

// ---- Admin Menu ----
function rte_add_admin_menu() {
    add_menu_page(
        __( 'Reading Time Estimator', 'reading-time-estimator' ),
        __( 'Reading Time', 'reading-time-estimator' ),
        'manage_options',
        'reading-time-estimator',     // menu/page slug
        'rte_settings_page',
        'dashicons-clock',
        6
    );
}
add_action( 'admin_menu', 'rte_add_admin_menu' );

// ---- Enqueue assets only on our page ----
function rte_enqueue_assets( $hook ) {
    if ( $hook !== 'toplevel_page_reading-time-estimator' ) {
        return;
    }
    wp_enqueue_style( 'rte-popup-style', RTE_PLUGIN_URL . 'assets/css/style.css', array(), RTE_VERSION );
    wp_enqueue_script( 'rte-popup-script', RTE_PLUGIN_URL . 'assets/js/script.js', array( 'jquery' ), RTE_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'rte_enqueue_assets' );

// ---- Shortcode: [rte_welcome] ----
function rte_welcome_shortcode( $atts ) {
    $text = get_option( 'rte_welcome_text', '' );
    if ( ! $text ) {
        $text = __( 'Welcome to Time Estimator Plugin!', 'reading-time-estimator' );
    }
    // Allow safe HTML, auto-wrap into <p>
    return wpautop( wp_kses_post( $text ) );
}
add_shortcode( 'rte_welcome', 'rte_welcome_shortcode' );
