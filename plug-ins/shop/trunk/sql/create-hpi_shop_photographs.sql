-- 
-- Table structure for table `hpi_shop_photographs`
-- 

CREATE TABLE `hpi_shop_photographs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `full_size_image_id` int(10) unsigned NOT NULL,
  `medium_size_image_id` int(10) unsigned NOT NULL,
  `thumbnail_image_id` int(10) unsigned NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

