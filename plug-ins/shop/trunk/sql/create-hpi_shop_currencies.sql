-- 
-- Table structure for table `hpi_shop_currencies`
-- 

CREATE TABLE `hpi_shop_currencies` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iso_4217_code` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `symbol` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
