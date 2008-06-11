
-- 
-- Table structure for table `hpi_shop_shopping_baskets`
-- 

CREATE TABLE IF NOT EXISTS `hpi_shop_shopping_baskets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `session_id` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `size` varchar(20) character set utf8 collate utf8_unicode_ci default NULL,
  `colour` varchar(12) character set utf8 collate utf8_unicode_ci default NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `customer_region_id` int(10) unsigned default NULL,
  `quantity` int(10) unsigned NOT NULL,
  `deleted` enum('yes','no') NOT NULL default 'no',
  `moved_to_orders` enum('yes','no') NOT NULL default 'no',
  `txn_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

