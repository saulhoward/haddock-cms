<?php
/**
 * FeedAggregator_PageHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_PageHelper
{
    public static function
        get_feed_summaries_div(
            $tags,                     // array
            $number_of_feeds,
            $number_of_items_per_feed
        )
    {
        $feeds = FeedAggregator_DatabaseHelper::
            get_feeds_for_tags(
                $tags,
                $number_of_feeds
            );

        $div = new HTMLTags_Div();
        foreach ($feeds as $feed) {
            $feed['items'] = FeedAggregator_DatabaseHelper::get_items_for_feed_id($feed['id'], NULL, 0, $number_of_items_per_feed);
            $div->append(FeedAggregator_DisplayHelper::get_feed_summary_div($feed));
        }
        return $div;
    }
}
?>
