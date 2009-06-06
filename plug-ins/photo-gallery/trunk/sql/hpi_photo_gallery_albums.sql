-- 
-- Table structure for table `hpi_photo_gallery_albums`
-- 

CREATE TABLE `hpi_photo_gallery_albums` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `title` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
	  `description` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
	  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

