-- 
-- Table structure for table `hpi_shop_customers`
-- 

CREATE TABLE `hpi_shop_customers` (
  `id` int(11) NOT NULL auto_increment,
  `added` datetime default NULL,
  `last_logged_in` datetime default NULL,
  `first_name` varchar(255) character set utf8 collate utf8_roman_ci default NULL,
  `last_name` varchar(255) character set utf8 collate utf8_roman_ci default NULL,
  `login_name` varchar(255) character set utf8 collate utf8_roman_ci default NULL,
  `password` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `email_address` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `address_id` int(11) default NULL,
  `telephone_number_id` int(11) default NULL,
  `customer_region_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
