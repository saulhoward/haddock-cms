-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_customer_region_supplier_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `customer_region_id` int(10) unsigned NOT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
 