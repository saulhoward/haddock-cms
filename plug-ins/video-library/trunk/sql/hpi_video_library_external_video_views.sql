-- 
-- Table structure for table `hpi_video_library_external_video_views`
-- 

CREATE TABLE `hpi_video_library_external_video_views` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `external_video_id` int(10) unsigned NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  `from`  int(10) unsigned NOT NULL,
  `to`  int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `external_video_id` (`external_video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

