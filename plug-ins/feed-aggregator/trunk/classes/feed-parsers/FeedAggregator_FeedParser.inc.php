<?php
/**
 * FeedAggregator_FeedParser
 *
 * @copyright 2010-03-24, SANH
 *
 *
 */

abstract class
FeedAggregator_FeedParser
{
    $raw_feed_data;

    protected function
        get_raw_feed_data()
    {
        if (!isset($this->raw_feed_data)) {
            $this->set_raw_feed_data();
        }
        return $this->raw_feed_data;
    }

    protected function
        set_raw_feed_data($data)
    {
        $this->raw_feed_data = $data;
    }

	abstract public function
		get_items();
}
?>
