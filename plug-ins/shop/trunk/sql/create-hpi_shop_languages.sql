-- 
-- Table structure for table `hpi_shop_languages`
-- 

CREATE TABLE `hpi_shop_languages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iso_639_1_code` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

