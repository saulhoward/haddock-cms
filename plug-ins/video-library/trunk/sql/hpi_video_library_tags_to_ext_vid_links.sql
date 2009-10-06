-- 
-- Table structure for table `hpi_video_library_tags_to_ext_vid_links`
-- 

CREATE TABLE `hpi_video_library_tags_to_ext_vid_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tag_id` int(10) unsigned NOT NULL,
  `external_video_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tag_id` (`tag_id`,`external_video_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

