-- Table structure for table `hc_database_pages`
--
-- DEPRECATED!!
--
-- Moved to its own plug-in module.
--
-- © Clear Line Web Design, 2007-08-30

CREATE TABLE `hc_database_pages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `html_content` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
