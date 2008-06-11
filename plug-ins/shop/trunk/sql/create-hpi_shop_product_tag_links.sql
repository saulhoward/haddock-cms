-- 
-- Table structure for table `hpi_shop_product_tag_links`
-- 

CREATE TABLE `hpi_shop_product_tag_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_tag_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
