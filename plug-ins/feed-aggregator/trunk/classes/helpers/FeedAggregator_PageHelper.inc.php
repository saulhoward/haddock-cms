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
            $feeds,
            $number_of_items_per_feed
        )
    {
        $div = self::get_feed_div(
            $feeds,
            $number_of_items_per_feed,
            array(
                'length' => 'summaries'
            )
        );
        return $div;
    }

   public static function
        get_feed_headlines_div(
            $feeds,
            $number_of_items_per_feed
        )
    {
        $div = self::get_feed_div(
            $feeds,
            $number_of_items_per_feed,
            array(
                'length' => 'headlines'
            )
        );
        return $div;
    }

    public static function
        get_feeds(
            $tags,                     // array
            $number_of_feeds
        )
    {
        $feeds = FeedAggregator_DatabaseHelper::
            get_feeds_for_all_tags(
                $tags,
                NULL,
                0,
                $number_of_feeds
            );
        return $feeds;
    }

    public static function
        get_feed_div(
            $feeds,
            $number_of_items_per_feed,
            $options = array(
                'length' => 'summaries' // headlines, summaries, full
            )
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'feeds-wrapper');
        foreach ($feeds as $feed) {
            
            // print_r($feed);exit;

            /** 
             * summary_display_quantity_multiplier
             * This multiplier allows us to give some feeds more headlines if they
             * tend to have short summaries
             */
            if (
                $options['length'] == 'summaries'
                &&
                isset($feed['summary_display_quantity_multiplier'])
            ) {
                $number_of_items_per_feed =
                    round($number_of_items_per_feed * $feed['summary_display_quantity_multiplier']);
            }

            $feed['items'] = 
                FeedAggregator_DatabaseHelper::get_items_for_feed_id(
                    $feed['id'],
                    NULL,
                    0,
                    $number_of_items_per_feed
                );
            // print_r($feed);exit;


            switch ($options['length']) {
            case 'summaries':
                $div->append(
                    FeedAggregator_DisplayHelper::get_feed_summary_div($feed)
                );
                break;
            case 'headlines':
                $div->append(
                    FeedAggregator_DisplayHelper::get_feed_headlines_div($feed)
                );
                break;
            default:
                $div->append(
                    FeedAggregator_DisplayHelper::get_feed_summary_div($feed)
                );
            }
        }
        return $div;
    }

    public static function
        get_image_feeds_div(
            $tags,                     // array
            $number_of_feeds,
            $number_of_items_per_feed
        )
    {
        $feeds = FeedAggregator_DatabaseHelper::
            get_feeds_for_all_tags(
                $tags,
                NULL,
                0,
                $number_of_feeds
            );

        $div = new HTMLTags_Div();
        foreach ($feeds as $feed) {
            $feed['items'] = 
                FeedAggregator_DatabaseHelper::get_items_for_feed_id(
                    $feed['id'],
                    NULL,
                    0,
                    $number_of_items_per_feed
                );
            $div->append(FeedAggregator_DisplayHelper::get_images_only_feed_div($feed));
        }
        return $div;
    }

}
?>
