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
		get_page_builder_class_name()
	{
		return trim($this->get_default_feed_retrieval_frequency_in_minutes('feed-retrieval-queue/default-feed-retrieval-frequency-in-minutes'));
	}
}
?>
