-- 
-- Table structure for table `hpi_video_library_external_video_providers`
-- 

CREATE TABLE `hpi_video_library_external_video_providers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `url` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `haddock_class_name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `status` enum('hide','display') NOT NULL default 'hide',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

