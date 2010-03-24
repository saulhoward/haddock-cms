<?php
/**
 * FeedAggregator_FeedHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_FeedHelper
{
	public static function
        correct_feed_name($name)
    {
        /* TODO:
         * Names should be unique and contain only
         * alphanumeric chars and underscores
         */

        return trim($name);
    }
	

}
?>
