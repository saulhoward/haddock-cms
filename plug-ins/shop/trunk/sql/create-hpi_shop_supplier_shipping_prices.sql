-- 
-- Table structure for table `hpi_shop_supplier_shipping_prices`
-- 

CREATE TABLE `hpi_shop_supplier_shipping_prices` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `supplier_id` int(10) unsigned NOT NULL,
  `customer_region_id` int(10) unsigned NOT NULL,
  `product_category_id` int(10) unsigned NOT NULL,
  `first_price` int(10) unsigned NOT NULL,
  `additional_price` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

