<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function rte_settings_page() { ?>
    <div class="wrap">
        <h1><?php echo esc_html__( 'Reading Time Estimator', 'reading-time-estimator' ); ?></h1>
        <p><?php echo esc_html__( 'Manage the welcome text that appears via shortcode on the frontend.', 'reading-time-estimator' ); ?></p>

        <!-- Settings API form -->
        <form action="options.php" method="post" style="max-width:720px;">
            <?php
                settings_fields( 'rte_settings' );          // nonce + option group
                do_settings_sections( 'reading-time-estimator' );
                submit_button( __( 'Save Changes', 'reading-time-estimator' ) );
            ?>
        </form>

        <hr>

        <h2><?php echo esc_html__( 'Live Preview', 'reading-time-estimator' ); ?></h2>
        <div class="notice notice-info" style="padding:12px;">
            <?php
                $preview = get_option( 'rte_welcome_text', '' );
                echo wpautop( wp_kses_post( $preview ?: __( 'Welcome to Time Estimator Plugin!', 'reading-time-estimator' ) ) );
            ?>
        </div>

        <p><code>[rte_welcome]</code> — <?php echo esc_html__( 'Use this shortcode in any page/post to show the welcome text.', 'reading-time-estimator' ); ?></p>

        <!-- Optional: Popup demo button (your earlier UI) -->
        <button id="rte-open-popup" class="button button-primary">
            <?php echo esc_html__( 'Open Popup', 'reading-time-estimator' ); ?>
        </button>
    </div>

    <!-- Popup markup -->
    <div id="rte-popup" class="rte-popup">
        <div class="rte-popup-content">
            <span class="rte-close">&times;</span>
            <h2><?php echo esc_html__( 'Welcome to Time Estimator Plugin 🎉', 'reading-time-estimator' ); ?></h2>
            <p><?php echo esc_html__( 'This is a nice animated popup modal with smooth transitions.', 'reading-time-estimator' ); ?></p>
        </div>
    </div>
<?php }
