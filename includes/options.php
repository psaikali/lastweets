<?php

namespace Lastweets\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Register our admin settings page, tabs and fields.
 *
 * @return void
 */
function options_initialize_admin_page() {
	$tabs = apply_filters( 'lastweets_options_tabs', [] );

	if ( empty( $tabs ) ) {
		return;
	}

	// Register our admin page.
	$theme_options = Container::make( 'theme_options', __( 'Lastweets', 'lastweets' ) );
	$theme_options->set_page_parent( 'options-general.php' );
	$theme_options->set_page_file( 'lastweets' );
	$theme_options->set_page_menu_title( 'Lastweets' );

	// Add tabs and fields.
	foreach ( $tabs as $tab_slug => $tab_title ) {
		$theme_options->add_tab(
			esc_html( $tab_title ),
			apply_filters( "lastweets_options_fields_tab_{$tab_slug}", [] )
		);
	}
}
add_action( 'carbon_fields_register_fields', __NAMESPACE__ . '\\options_initialize_admin_page' );

/**
 * Options tabs list
 *
 * @param array $tabs [] Initial (filtered) tabs array.
 * @return array $tabs Array of tabs.
 */
function options_set_tabs( $tabs ) {
	return [
		'general'  => __( 'General', 'lastweets' ),
		'theme' => __( 'Theme', 'lastweets' ),
	];
}
add_filter( 'lastweets_options_tabs', __NAMESPACE__ . '\\options_set_tabs' );

/**
 * "General" option tab fields
 *
 * @return array $fields The fields array
 */
function options_general_option_tab_fields() {
	$fields = [];

	// API keys.
	$fields[] = Field::make( 'text', 'lastweets_consumer_key', __( 'Consumer API Key', 'lastweets' ) )->set_required();
	$fields[] = Field::make( 'text', 'lastweets_consumer_secret', __( 'Consumer API secret key', 'lastweets' ) )->set_required();
	$fields[] = Field::make( 'text', 'lastweets_access_token', __( 'Access token ', 'lastweets' ) )->set_required();
	$fields[] = Field::make( 'text', 'lastweets_access_token_secret', __( 'Access token secret', 'lastweets' ) )->set_required();

	return $fields;
}
add_filter( 'lastweets_options_fields_tab_general', __NAMESPACE__ . '\\options_general_option_tab_fields', 10 );

/**
 * "Theme" option tab fields
 *
 * @return array $fields The fields array
 */
function options_theme_option_tab_fields() {
	$fields = [];

	// Load CSS styles?
	$fields[] = Field::make( 'checkbox', 'lastweets_load_css', __( 'Load plugin CSS styles to enhance tweets design.', 'lastweets' ) )->set_option_value( 'yes' )->set_default_value( 'yes' );

	return $fields;
}
add_filter( 'lastweets_options_fields_tab_theme', __NAMESPACE__ . '\\options_theme_option_tab_fields', 10 );

/**
 * Display support / doc content in the sidebar
 *
 * @return void
 */
function display_content_after_sidebar() {
	?>
	<?php
}
//add_action( 'carbon_fields_container_lastweets_after_sidebar', __NAMESPACE__ . '\\display_content_after_sidebar' );