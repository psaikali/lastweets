<?php

namespace Lastweets\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles
 */
function enqueue_assets( $hook ) {
	// wp_enqueue_script( 'lastweets/global', LASTWEETS_URL . 'assets/js/global.js', [ 'jquery', 'lib/flatpickr' ], LASTWEETS_VERSION );
	// wp_enqueue_style( 'lastweets/global', LASTWEETS_URL . 'assets/css/global.css', [], LASTWEETS_VERSION );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
