-- Table structure for table `hpi_polls_votes`
-- 

CREATE TABLE `hpi_polls_votes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `answer_id` int(11) unsigned NOT NULL,
  `submitted` datetime NOT NULL,
  `remote_address` varchar(255) character set ascii collate ascii_bin NOT NULL,
  `session_id` varchar(255) character set ascii collate ascii_bin NOT NULL,
  `http_user_agent` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
