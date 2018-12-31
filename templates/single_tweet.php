<?php 
$enhanced_tweet = Lastweets\Functions\refactor_tweet_object( $tweet );
?>
<article class="lastweet-tweet">
	<header>
		<a target="_blank" rel="nofollow" href="<?php echo esc_url( $enhanced_tweet->user->url ); ?>">
			<img src="<?php echo esc_url( $enhanced_tweet->user->avatar ); ?>" alt="<?php echo esc_attr( $enhanced_tweet->user->name ); ?>" />
			<p>
				<?php echo $enhanced_tweet->user->name; ?>
				<small><?php echo sprintf( '@%1$s', $enhanced_tweet->user->screen_name ); ?></small>
				<time><?php echo date_i18n( get_option( 'date_format' ), $enhanced_tweet->date ); ?></time>
			</p>
		</a>
	</header>

	<blockquote>
		<?php echo $enhanced_tweet->text; ?>
	</blockquote>

	<footer>
		<a target="_blank" rel="nofollow" href="<?php echo esc_url( $enhanced_tweet->url ); ?>">
			<span><i class="fas fa-retweet"></i> <?php echo $enhanced_tweet->retweets_count; ?></span>
			<span><i class="fas fa-heart"></i> <?php echo $enhanced_tweet->favorites_count; ?></span>
		</a>
	</footer>
</article>