-- 
-- Table structure for table `hpi_shop_suppliers`
-- 

CREATE TABLE `hpi_shop_suppliers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `contact_name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `notes` text character set utf8 collate utf8_roman_ci NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `email_address_id` int(10) unsigned NOT NULL,
  `telephone_number_id` int(10) unsigned NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
