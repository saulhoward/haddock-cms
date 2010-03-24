-- 
-- Table structure for table `hpi_feed_aggregator_cache`
-- 

CREATE TABLE `hpi_feed_aggregator_cache` (
    `id` int(10) unsigned NOT NULL auto_increment,
    `feed_id` int(10) unsigned NOT NULL,
    `unique_item_id` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `date_retrieved` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `full_content` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `title` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `link` varchar(255) character set ucs2 collate ucs2_roman_ci NOT NULL,
    `updated` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    `summary` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

