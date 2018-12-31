<?php

namespace Lastweets\Gutenblock;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Block;
use Carbon_Fields\Field;

/**
 * Register our shiny Gutenblock
 */
function register_gutenblock() {
	$fields = apply_filters( 'lastweets_gutenblock_fields', [] );

	if ( empty( $fields ) ) {
		return;
	}

	$gutenblock = Block::make( __( 'Lastweets block', 'lastweets' ) );
	$gutenblock->set_category( 'embed' );
	$gutenblock->set_description( __( 'Display a list of latest tweets for a specific Twitter account.', 'lastweets' ) );
	$gutenblock->set_keywords( [ 'twitter', 'tweet', 'lastweet' ] );
	$gutenblock->set_icon( 'twitter' );
	$gutenblock->add_fields( $fields );
	$gutenblock->set_preview_mode( true );
	$gutenblock->set_render_callback( function ( $block ) {
		render_gutenblock( $block );
	} );
}
add_action( 'carbon_fields_register_fields', __NAMESPACE__ . '\\register_gutenblock' );

/**
 * Add Gutenblock fields
 *
 * @param array $fields Array of CF fields
 * @return array $fields Array of new CF fields
 */
function add_core_gutenblock_fields( $fields = [] ) {
	$fields[] = Field::make( 'text', 'account', __( 'Twitter account', 'lastweets' ) )->set_attribute( 'placeholder', '@psaikali' )->set_width( 75 );
	$fields[] = Field::make( 'text', 'amount', __( 'Number of tweets', 'lastweets' ) )->set_attribute( 'type', 'number' )->set_attribute( 'placeholder', 5 )->set_width( 25 );
	$fields[] = Field::make( 'select', 'style', __( 'Appearance', 'lastweets' ) )->set_options(
		[
			'oembed' => __( 'Embed widget', 'lastweets' ),
			'theme'  => __( 'Custom design', 'lastweets' ),
		]
	)->set_default_value( 'theme' )->set_width( 50 );
	$fields[] = Field::make( 'checkbox', 'retweets', __( 'Display retweets?', 'lastweets' ) )->set_option_value( 'yes' )->set_width( 50 );

	return $fields;
}
add_filter( 'lastweets_gutenblock_fields', __NAMESPACE__ . '\\add_core_gutenblock_fields' );

/**
 * Render our Gutenblock on the front-end
 *
 * @param array $block The block data.
 * @return void
 */
function render_gutenblock( $block ) {
	var_dump( $block );
}
