-- 
-- Table structure for table `hpi_feed_aggregator_tags_to_feed_links`
-- 

CREATE TABLE `hpi_feed_aggregator_tags_to_feed_links` (
    `id` int(10) unsigned NOT NULL auto_increment,
    `tag_id` int(10) unsigned NOT NULL,
    `feed_id` int(10) unsigned NOT NULL,
    PRIMARY KEY  (`id`),
    UNIQUE KEY `tag_id` (`tag_id`,`feed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

