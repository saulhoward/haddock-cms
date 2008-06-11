-- 
-- Table structure for table `hpi_shop_customer_region_supplier_links`
-- 

CREATE TABLE `hpi_shop_customer_region_supplier_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `customer_region_id` int(10) unsigned NOT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
