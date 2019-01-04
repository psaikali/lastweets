=== Lastweets ===
Contributors: pskli
Tags: twitter, tweet, latest tweet, oembed
Requires at least: 4.8
Tested up to: 5.0.2
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Display a Twitter account latest tweets via a Gutenberg editor block.
 
== Description ==
## Philosophy
This is a simple plugin that will not load a sh*t-load of CSS. Instead, the bare minimum stylings are done for the custom theme so that anyone can customize it with their site design.
It is very developer friendly and offers a couple of smart filters and actions to modify default logic (see `HOOKS.md` file).
You can override the custom default theme template to display a tweet by copying the `/templates/single_tweet.php` file and pasting it in your theme `/templates/lastweets-single_tweet.php` folder. 
This file will be used to display a tweet; customize it the way you want.

## Available hooks
...to be continued...

## Built with
- [Carbon Fields library](https://carbonfields.net) for managing the plugin admin settings page.
- [Twitter API PHP](https://github.com/J7mbo/twitter-api-php) to interrogate Twitter API to fetch tweets.

## Authors
* **Pierre Saïkali** - *Initial work* - [Mosaika](https://mosaika.fr) / [Saika.li](https://saika.li)
See also the list of [contributors](https://github.com/psaikali/lastweets/graphs/contributors) who participated in this project.

== Installation ==
After installing and activating the plugin, heads to the `Settings > Lastweets` options page.
From there, you can define your Twitter app API keys.
Go to https://developer.twitter.com/en/apps to create a Twitter application and retrieve your API keys.

== Screenshots ==

1. Example of a timeline created with this plugin.
2. Managing different timelines is simple!
3. Every single timeline achievement is a unique post categorized in one or multiple timelines.
4. You can add timelines directly within the brand new Gutenberg block editor.
5. Plugin options page.
 
== Changelog ==
 
= 1.0.0 - 2019-01-04 =
* First version of the plugin \o/