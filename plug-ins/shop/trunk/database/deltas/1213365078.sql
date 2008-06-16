-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_texts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
