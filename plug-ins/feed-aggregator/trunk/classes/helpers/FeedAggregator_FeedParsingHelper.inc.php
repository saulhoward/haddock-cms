<?php
/**
 * FeedAggregator_ParsingFeedHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_ParsingFeedHelper
{
	public static function
        get_feed_parser($name)
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'feed-aggregator');
        return
            new $config_manager->get_feed_parser();
    }
	

}
?>
