-- 
-- Table structure for table `hpi_feed_aggregator_feeds`
-- 

CREATE TABLE `hpi_feed_aggregator_feeds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `description` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `url` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `format` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `sort_order` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

