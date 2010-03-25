<?php
/**
 * FeedAggregator_DisplayHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_DisplayHelper
{
    public static function
        get_feed_summaries_div(
            $tags,                     // array
            $number_of_feeds,
            $number_of_items_per_feed
        )
    {

    }

    public static function
        get_tags_csv_string(
            $tags
        )
    {
        //print_r($tags);exit;
        $html = '';
        $i = 0;
        foreach ($tags as $tag) {
            if ($i != 0) {
                $html .= ', ';
            }
            $i++;
            $html .= $tag['tag'];
        }
        return $html;
    }


}
?>
