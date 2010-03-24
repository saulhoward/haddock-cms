-- 
-- Table structure for table `hpi_feed_aggregator_retrieval_queue`
-- 

CREATE TABLE `hpi_feed_aggregator_retrieval_queue` (
    `id` int(10) unsigned NOT NULL auto_increment,
    `feed_id` int(10) unsigned NOT NULL,
    `frequency_minutes` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `last_retrieved` datetime default NULL,
    `status` enum('retrieve','skip') NOT NULL default 'skip',
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

