-- Table structure for table `hpi_trackit_stock_management_stock_levels`
-- 

CREATE TABLE `hpi_trackit_stock_management_stock_levels` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`site_id` int(3) unsigned NOT NULL,
	`product_id` varchar(15) character set ascii collate ascii_bin NOT NULL,
	`size` varchar(20) character set ascii collate ascii_bin NOT NULL,
	`colour` varchar(12) character set ascii collate ascii_bin NOT NULL,
	`quantity` decimal(7,2) unsigned NOT NULL,
	PRIMARY KEY  (`id`),
	UNIQUE KEY `product` (`product_id`,`size`,`colour`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

