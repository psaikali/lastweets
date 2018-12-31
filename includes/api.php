<?php

namespace Lastweets\Api;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get latest tweets of an account
 *
 * @param string $username The twitter username
 * @return mixed Array of tweets or null
 */
function get_latest_tweet( $username = 'psaikali', $amount = 1 ) {
	if ( defined( 'TWITTER_OAUTH_ACCESS_TOKEN' ) && defined( 'TWITTER_OAUTH_ACCESS_TOKEN_SECRET' ) && defined( 'TWITTER_CONSUMER_KEY' ) && defined( 'TWITTER_CONSUMER_SECRET' ) ) {
		$transient_name = 'innov_latest_tweet' . $username;

		if ( false === ( $tweets = get_transient( $transient_name ) ) ) {
			$settings = [
				'oauth_access_token'        => TWITTER_OAUTH_ACCESS_TOKEN,
				'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
				'consumer_key'              => TWITTER_CONSUMER_KEY,
				'consumer_secret'           => TWITTER_CONSUMER_SECRET,
			];

			$url    = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$params = "?count=1&exclude_replies=true&tweet_mode=extended&screen_name={$username}";

			try {
				$twitter = new \TwitterAPIExchange( $settings );
				$tweets   = json_decode( $twitter->setGetfield( $params )->buildOauth( $url, 'GET' )->performRequest() );
			} catch ( \Exception $e ) {
				return null;
			}

			set_transient( $transient_name, $tweets, 30 * MINUTE_IN_SECONDS );
		}

		if ( is_array( $tweets ) ) {
			return $tweets;
		}
	}

	return null;
}
