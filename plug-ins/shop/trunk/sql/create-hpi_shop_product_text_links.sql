-- 
-- Table structure for table `hpi_shop_product_text_links`
-- 

CREATE TABLE `hpi_shop_product_text_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `name_text_id` int(10) unsigned NOT NULL,
  `description_text_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

