-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_product_tag_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_tag_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
