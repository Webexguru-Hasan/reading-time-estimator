<?php
// Security check
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete all plugin data
delete_option( 'rte_welcome_text' );
