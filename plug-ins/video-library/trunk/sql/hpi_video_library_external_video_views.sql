-- 
-- Table structure for table `hpi_video_library_external_video_views`
-- 

CREATE TABLE `hpi_video_library_external_video_views` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `external_video_id` int(10) unsigned NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  `from` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `to` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `external_video_id` (`external_video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

