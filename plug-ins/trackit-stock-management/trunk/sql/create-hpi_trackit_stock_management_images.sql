-- Table structure for table `hpi_trackit_stock_management_images`
-- 

CREATE TABLE `hpi_trackit_stock_management_images` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

