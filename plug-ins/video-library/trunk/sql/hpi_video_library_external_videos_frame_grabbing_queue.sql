-- 
-- Table structure for table
-- `hpi_video_library_external_videos_frame_grabbing_queue`
-- 

CREATE TABLE `hpi_video_library_external_videos_frame_grabbing_queue` (
          `id` int(10) unsigned NOT NULL auto_increment,
          `external_video_id` int(10) unsigned NOT NULL,
          `last_downloaded` varchar(255) collate utf8_roman_ci default NULL,
          `file_size` int(10) unsigned NOT NULL,
          `exists_in_file_system` enum('yes','no') character set latin1 NOT NULL default 'no',
          PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

