-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_products` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `description` text character set utf8 collate utf8_roman_ci NOT NULL,
  `product_category_id` int(10) unsigned NOT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  `product_brand_id` int(10) unsigned NOT NULL,
  `stock_level` int(10) unsigned NOT NULL,
  `use_stock_level` enum('yes','no') character set utf8 collate utf8_roman_ci NOT NULL default 'no',
  `stock_buffer_level` int(10) unsigned NOT NULL,
  `status` enum('hide','display') NOT NULL default 'hide',
  `sort_order` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
