-- 
-- Table structure for table `hpi_feed_aggregator_tags`
-- 

CREATE TABLE `hpi_feed_aggregator_tags` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `tag` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
	  `principal` enum('yes','no') character set utf8 collate utf8_roman_ci NOT NULL default 'no',
	  PRIMARY KEY  (`id`),
	  UNIQUE KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

