-- Delta file for the Trackit Stock Management module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_trackit_stock_management_stock_levels` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`site_id` int(3) unsigned NOT NULL,
	`product_id` varchar(15) character set ascii collate ascii_bin NOT NULL,
	`size` varchar(20) character set ascii collate ascii_bin NOT NULL,
	`colour` varchar(12) character set ascii collate ascii_bin NOT NULL,
	`quantity` decimal(7,2) unsigned NOT NULL,
	PRIMARY KEY  (`id`),
	UNIQUE KEY `product` (`product_id`,`size`,`colour`)
) ENGINE=MyISAM;
