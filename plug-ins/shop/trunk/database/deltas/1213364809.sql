-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_product_photograph_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL,
  `photograph_id` int(10) unsigned NOT NULL,
  `type` enum('main','design','extra') NOT NULL default 'extra',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pro_pho_typ` (`product_id`,`photograph_id`,`type`)
) ENGINE=MyISAM;
