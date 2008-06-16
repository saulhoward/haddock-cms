-- Delta file for the Trackit Stock Management module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_trackit_stock_management_product_image_links` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned NOT NULL,
  `image_id` int(11) unsigned NOT NULL,
  `sort_order` int(2) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
