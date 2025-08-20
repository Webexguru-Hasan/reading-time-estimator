<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    // Elementor এখনও লোড হয়নি এমন edge case হলে ফাইল নিরবে বেরিয়ে যান
    return;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class RTE_Elementor_Widget extends Widget_Base {
    public function get_name() {
        return 'rte_widget';
    }

    public function get_title() {
        return __( 'Reading Time Estimator', 'reading-time-estimator' );
    }

    public function get_icon() {
        return 'eicon-clock';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'reading-time-estimator' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_text',
            [
                'label'   => __( 'Custom Text', 'reading-time-estimator' ),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option( 'rte_welcome_text', 'Welcome to Reading Time Estimator!' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="rte-elementor-widget">' . esc_html( $settings['custom_text'] ) . '</div>';
    }
}
