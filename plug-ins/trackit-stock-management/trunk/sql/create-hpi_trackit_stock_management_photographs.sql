-- Table structure for table `hpi_trackit_stock_management_photographs`
-- 

CREATE TABLE `hpi_trackit_stock_management_photographs` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`trackit_feed_file_id` int(10) unsigned NOT NULL,
	`shop_photograph_id` int(10) unsigned NOT NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;