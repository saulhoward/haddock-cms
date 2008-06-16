-- Delta file for the Trackit Stock Management module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_trackit_stock_management_photographs` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`trackit_feed_file_id` int(10) unsigned NOT NULL,
	`shop_photograph_id` int(10) unsigned NOT NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
