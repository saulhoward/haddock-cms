-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_product_brands` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `owner` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `description` text character set utf8 collate utf8_roman_ci NOT NULL,
  `url` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `full_size_image_id` int(10) unsigned NOT NULL,
  `thumbnail_image_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
