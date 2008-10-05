-- 
-- Table structure for table `hpi_photo_gallery_photographs`
-- 

CREATE TABLE `hpi_photo_gallery_photographs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` longtext character set utf8 collate utf8_roman_ci NOT NULL,
  `added` datetime NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

