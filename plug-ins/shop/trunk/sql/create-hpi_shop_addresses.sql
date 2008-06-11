-- 
-- Table structure for table `hpi_shop_addresses`
-- 

CREATE TABLE `hpi_shop_addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `post_office_box` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `extended_address` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `street_address` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `locality` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `region` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `postal_code` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `country_name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
