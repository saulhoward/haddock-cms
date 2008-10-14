<?php
/**
 * RSS_RSSSimpleXMLElement
 *
 * @copyright 2008-10-14, SANH
 */

/**
 *  XML Object created by RSS_RSS
 *  extending RSS_SimpleXMLElement
 *
 */

class
RSS_RSSSimpleXMLElement
extends
RSS_SimpleXMLElement
{
	public function
		get_title()
	{
		return (string) $this->title;
	}

	public function
		get_url_filename()
	{
		return (string) $this->guid;
	}

	public function
		get_feed_title()
	{
		return (string) $this->channel->title;
	}

	public function
		get_items()
	{
		$items = array();

		// Works if RSS 2.0
		foreach ($this->channel->item as $item)
		{
			$items[] = $item;
		}
		return $items;
	}
	
}
?>
