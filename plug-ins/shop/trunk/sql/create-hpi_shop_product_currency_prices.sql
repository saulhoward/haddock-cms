-- 
-- Table structure for table `hpi_shop_product_currency_prices`
-- 

CREATE TABLE `hpi_shop_product_currency_prices` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 