<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Shortcode for frontend [rte_welcome]
function rte_welcome_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'tag' => 'div', // optional: ইউজার চাইলে কোন HTML tag দিবে, default div
        ),
        $atts,
        'rte_welcome'
    );

    $text = get_option( 'rte_welcome_text', 'Welcome to Time Estimator Plugin 🎉' );

    // esc_html এর বদলে wp_kses_post দিলে basic HTML backend থেকে allow হবে (bold, italic ইত্যাদি)
    return sprintf(
        '<%1$s class="rte-welcome-text">%2$s</%1$s>',
        tag_escape( $atts['tag'] ),
        wp_kses_post( $text )
    );
}
add_shortcode( 'rte_welcome', 'rte_welcome_shortcode' );

// Auto show in footer
function rte_show_in_footer() {
    // শুধু তখনই দেখাবে যখন option-এ কিছু আছে
    $text = get_option( 'rte_welcome_text', '' );
    if ( ! empty( $text ) ) {
        echo do_shortcode( '[rte_welcome]' );
    }
}
add_action( 'wp_footer', 'rte_show_in_footer' );
