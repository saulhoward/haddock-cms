-- 
-- Table structure for table `hpi_video_library_external_video_libraries`
-- 

CREATE TABLE `hpi_video_library_external_video_libraries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `description` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `sort_order` int(10) unsigned NOT NULL,
  `date_added` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `status` enum('hide','display') NOT NULL default 'hide',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

