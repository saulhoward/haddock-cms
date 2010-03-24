<?php
/**
 * FeedAggregator_FeedParsingHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_FeedParsingHelper
{
	public static function
        get_feed_parser()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'feed-aggregator');

        $class = $config_manager->get_feed_parser();
        return new $class;
    }
	

}
?>
