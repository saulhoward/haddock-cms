<?php
/**
 * FeedAggegator_FeedAggegatorSimpleXMLElement
 *
 * @copyright 2008-10-14, SANH
 */

/**
 *  XML Object created by FeedAggegator_FeedAggegator
 *  extending FeedAggegator_SimpleXMLElement
 *
 */

class
FeedAggegator_FeedAggegatorSimpleXMLElement
extends
FeedAggegator_SimpleXMLElement
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

		// Works if FeedAggegator 2.0
		foreach ($this->channel->item as $item)
		{
			$items[] = $item;
		}
		return $items;
	}
	
}
?>
