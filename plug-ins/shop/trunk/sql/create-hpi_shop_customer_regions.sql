-- 
-- Table structure for table `hpi_shop_customer_regions`
-- 

CREATE TABLE `hpi_shop_customer_regions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `description` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `sort_order` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
