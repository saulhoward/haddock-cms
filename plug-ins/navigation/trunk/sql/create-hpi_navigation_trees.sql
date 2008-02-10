-- Table structure for table `hpi_navigation_trees`
--
-- @copyright RFI 2007-12-30

CREATE TABLE IF NOT EXISTS `hpi_navigation_trees` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;