<?php
/**
 * FeedAggregator_SimplePieFeedParser
 *
 * @copyright 2010-03-24, SANH
 *
 * This class is a feed parser depends on SimplePie_SimplePie
 * which is in the simple-pie plugin
 *
 */

class
FeedAggregator_SimplePieFeedParser
extends
FeedAggregator_FeedParser
{
    private $simple_pie;

    protected function
        get_simple_pie()
    {
        if (!isset($this->simple_pie)) {
            $this->set_simple_pie();
        }
        return $this->simple_pie;
    }

    protected function
        set_simple_pie()
    {
        $this->simple_pie = new SimplePie_SimplePie();
    }

	public function
        get_title()
    {
        return $this->get_simple_pie()->get_title();
    }


	public function
        get_items()
    {
        return $this->get_simple_pie()->get_items();
    }

    public function
        set_raw_feed_data($feed_data)
    {
        parent::set_raw_feed_data($feed_data);
        $this->get_simple_pie()->set_raw_data($feed_data);
        $this->get_simple_pie()->init();
    }
}
?>
