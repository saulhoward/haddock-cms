<?php
/**
 * FeedAggregator_Feed
 *
 * @copyright 2008-10-14, SANH
 *
 *
 */

class
FeedAggregator_Feed
extends
FeedAggegator_SimpleXMLElement
{
	// public function
		// __construct(
			// $url, // FeedAggregator absolute url
			// $version // 'Atom' or 'RSS2' so we know which class to use
			// )
	// {
    // }
	abstract public function
		get_title();

	abstract public function
		get_url_filename();

	abstract public function
		get_feed_title();

	abstract public function
		get_items();

    protected function
        get_number_of_items()
    {
        return count($this->get_items());
    }

}
?>
