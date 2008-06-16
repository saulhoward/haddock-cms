-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE IF NOT EXISTS `hpi_shop_orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `shopping_basket_id` int(10) unsigned default NULL,
  `session_id` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `product_id` int(10) unsigned default NULL,
  `quantity` int(10) unsigned default NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `status` enum('pending','paid','dispatched') NOT NULL default 'pending',
  `deleted` enum('yes','no') NOT NULL default 'no',
  `txn_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
