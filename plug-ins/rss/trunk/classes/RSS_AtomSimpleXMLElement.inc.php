<?php
/**
 * RSS_AtomSimpleXMLElement
 *
 * @copyright 2008-10-14, SANH
 */

/**
 *  XML Object created by RSS_RSS
 *  extending RSS_SimpleXMLElement
 *
 */

class
RSS_AtomSimpleXMLElement
extends
RSS_SimpleXMLElement
{
	public function
		get_title()
	{
		// Works for atom
		return (string) $this->title;
	}

	public function
		get_url_filename()
	{
		// Works for atom
		return (string) $this->link->attributes()->href;
	}

	public function
		get_feed_title()
	{
		return (string) $this->title;
	}

	public function
		get_items()
	{
		$items = array();

		// Works if Atom
		foreach ($this->entry as $item)
		{
			$items[] = $item;
		}
		return $items;
	}
}
?>
