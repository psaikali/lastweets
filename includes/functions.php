<?php

namespace Lastweets\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Lastweets\Api;

/**
 * Display latest tweet
 */
function display_latest_tweet( $username = 'psaikali', $amount = 1, $oembed = true ) {
	$tweet = Api\get_latest_tweet( $username );

	if ( $tweet ) {
		// Oembed widget.
		if ( $oembed ) {
			if ( isset( $tweet->retweeted_status->id ) ) {
				$url = "https://twitter.com/{$tweet->retweeted_status->user->screen_name}/status/{$tweet->retweeted_status->id}";
			} else {
				$url = "https://twitter.com/{$tweet->user->screen_name}/status/{$tweet->id}";
			}

			echo \wp_oembed_get( $url );
		} else {
			// Homemade widget.
			if ( isset( $tweet->retweeted_status->id ) ) {
				$tweet_object = $tweet->retweeted_status;
			} else {
				$tweet_object = $tweet;
			}

			output_custom_tweet( (object) [
				'id'              => $tweet_object->id,
				'url'             => "https://twitter.com/{$tweet_object->user->screen_name}/status/{$tweet_object->id}",
				'date'            => strtotime( $tweet_object->created_at ),
				'text'            => $tweet_object->full_text,
				'retweets_count'  => $tweet_object->retweet_count,
				'favorites_count' => $tweet_object->favorite_count,
				'user'            => (object) [
					'name'        => $tweet_object->user->name,
					'screen_name' => $tweet_object->user->screen_name,
					'avatar'      => $tweet_object->user->profile_image_url_https,
					'url'         => "https://twitter.com/{$tweet_object->user->screen_name}",
				],
			] );
		}
	}
}

/**
 * Custom display of a tweet
 */
function output_custom_tweet( $tweet ) {
	$tweet->text = preg_replace( '/#+([a-zA-ZÀ-ÖØ-öø-ÿ0-9_]+)/', '<a target="_blank" rel="nofollow" href="https://twitter.com/search?q=$1">$0</a>', $tweet->text );
	$tweet->text = preg_replace( '/@+([a-zA-Z0-9_]+)/', '<a target="_blank" rel="nofollow" href="https://twitter.com/$1">$0</a>', $tweet->text );
	?>
	<div class="tweet">
		<header>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( $tweet->user->url ); ?>">
				<img src="<?php echo esc_url( $tweet->user->avatar ); ?>" alt="<?php echo esc_attr( $tweet->user->name ); ?>" />
				<p>
					<?php echo $tweet->user->name; ?>
					<small><?php echo sprintf( '@%1$s', $tweet->user->screen_name ); ?></small>
					<time><?php echo date_i18n( get_option( 'date_format' ), $tweet->date ); ?></time>
				</p>
			</a>
		</header>

		<blockquote>
			<?php echo str_replace( [ '>http://', '>https://' ], [ '>', '>' ], make_clickable( $tweet->text ) ); ?>
		</blockquote>

		<footer>
			<a target="_blank" rel="nofollow" href="<?php echo esc_url( $tweet->url ); ?>">
				<span><i class="fas fa-retweet"></i> <?php echo $tweet->retweets_count; ?></span>
				<span><i class="fas fa-heart"></i> <?php echo $tweet->favorites_count; ?></span>
			</a>
		</footer>
	</div>
	<?php
}
