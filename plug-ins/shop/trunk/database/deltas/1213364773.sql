-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_product_currency_prices` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
