-- 
-- Table structure for table `hpi_video_library_ext_vid_to_ext_vid_lib_links`
-- 

CREATE TABLE `hpi_video_library_ext_vid_to_ext_vid_lib_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `external_video_id` int(10) unsigned NOT NULL,
  `external_video_library_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `external_video_id` (`external_video_id`,`external_video_library_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

