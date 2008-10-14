<?php
/**
 * RSS_SimpleXMLElement
 *
 * @copyright 2008-10-14, SANH
 */

/**
 *  XML Object created by RSS_RSS
 *  extending SimpleXMLElement
 *  and to be extended itself into rss, atom etc
 *
 */

abstract class
RSS_SimpleXMLElement
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
