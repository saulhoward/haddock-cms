-- 
-- Table structure for table `hpi_trackit_stock_management_product_image_links`
-- 

CREATE TABLE `hpi_trackit_stock_management_product_image_links` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned NOT NULL,
  `image_id` int(11) unsigned NOT NULL,
  `sort_order` int(2) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
