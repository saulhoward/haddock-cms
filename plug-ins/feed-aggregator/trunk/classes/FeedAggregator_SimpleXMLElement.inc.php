<?php
/**
 * FeedAggegator_SimpleXMLElement
 *
 * @copyright 2008-10-14, SANH
 */

/**
 *  XML Object created by FeedAggegator_FeedAggegator
 *  extending SimpleXMLElement
 *  and to be extended itself into rss, atom etc
 *
 */

abstract class
FeedAggegator_SimpleXMLElement
extends
SimpleXMLElement
{
	abstract public function
		get_title();

	abstract public function
		get_url_filename();

	abstract public function
		get_feed_title();

	abstract public function
		get_items();
}
?>
