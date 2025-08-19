<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function rte_settings_page() {
    ?>
    <div class="wrap">
        <h1>Reading Time Estimator</h1>
        <p>This plugin adds an estimated reading time above your posts.</p>
        <p>Currently: <strong>200 words per minute</strong></p>

        <!-- Button -->
        <button id="rte-open-popup" class="button button-primary">
            Open Popup
        </button>
    </div>

    <!-- Popup -->
    <div id="rte-popup" class="rte-popup">
        <div class="rte-popup-content">
            <span class="rte-close">&times;</span>
            <h2>Welcome to Time Estimator Plugin 🎉</h2>
            <p>This is a nice animated popup modal with smooth transitions.</p>
        </div>
    </div>
    <?php
}
