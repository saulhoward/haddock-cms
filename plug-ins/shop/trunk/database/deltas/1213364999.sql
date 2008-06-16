-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_supplier_shipping_prices` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `supplier_id` int(10) unsigned NOT NULL,
  `customer_region_id` int(10) unsigned NOT NULL,
  `product_category_id` int(10) unsigned NOT NULL,
  `first_price` int(10) unsigned NOT NULL,
  `additional_price` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
