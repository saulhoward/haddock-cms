-- Table structure for table `hpi_trackit_stock_management_products`
-- 

CREATE TABLE `hpi_trackit_stock_management_products` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`site_id` int(3) NOT NULL,
	`product_id` varchar(15) character set ascii NOT NULL,
	`supplier_code` varchar(16) character set ascii NOT NULL,
	`size` varchar(100) character set ascii NOT NULL,
	`colour` varchar(100) character set ascii NOT NULL,
	`unit_price` decimal(7,2) unsigned NOT NULL,
	`tax_rate` decimal(5,2) unsigned NOT NULL,
	`weight` decimal(3,2) NOT NULL,
	`category_1` varchar(20) character set ascii NOT NULL,
	`category_2` varchar(20) character set ascii NOT NULL,
	`category_3` varchar(20) character set ascii NOT NULL,
	`new` enum('Y','N') NOT NULL,
	`top` enum('Y','N') NOT NULL,
	`special` enum('Y','N') NOT NULL,
	`visible` enum('Y','N') NOT NULL,
	`image_name` varchar(100) character set ascii NOT NULL,
	`description` varchar(50) character set ascii NOT NULL,
	`meta_description` varchar(400) character set ascii NOT NULL,
	`keywords` varchar(400) character set ascii NOT NULL,
	`meta_keywords` varchar(400) character set ascii NOT NULL,
	`full_description` text character set ascii NOT NULL,
	`synched_with_shop` enum('Yes','No') character set ascii collate ascii_bin NOT NULL default 'No',
	`shop_product_id` int(10) unsigned default NULL,
	PRIMARY KEY  (`id`),
	UNIQUE KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;