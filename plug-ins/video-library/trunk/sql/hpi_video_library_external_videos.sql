--
-- Table structure for table `hpi_video_library_external_videos`
--

CREATE TABLE IF NOT EXISTS `hpi_video_library_external_videos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `date_added` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `external_video_provider_id` int(10) unsigned NOT NULL,
  `providers_internal_id` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `providers_url` varchar(255) NOT NULL,
  `thumbnail_url` varchar(255) character set utf8 collate utf8_roman_ci default NULL,
  `status` enum('hide','display') NOT NULL default 'hide',
  `length_seconds` int(10) unsigned default NULL,
  `added_by` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `last_edited_by` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `date_last_edited` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

