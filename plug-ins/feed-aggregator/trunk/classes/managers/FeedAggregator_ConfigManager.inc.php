<?php
/**
 * FeedAggregator_ConfigManager
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_ConfigManager
extends
HaddockProjectOrganisation_ConfigManager
{
    protected function
        get_module_prefix_string()
    {
        return '/plug-ins/feed-aggregator/';
    }

    public function
        get_default_feed_retrieval_frequency_in_minutes()
    {
        return trim(
            $this->get_config_value('feed-retrieval-queue/default-feed-retrieval-frequency-in-minutes')
        );
    }

    public function
        get_feed_parser()
    {
        return trim(
            $this->get_config_value('feed-parser/class-name')
        );
    }

    public function
        get_item_page_class_name()
    {
        return trim(
            $this->get_config_value('page-classes/item-page-class')
        );
    }

}
?>
