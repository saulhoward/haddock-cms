-- Delta file for the Navigation module
-- (c) 2008-06-13, Robert Impey


CREATE TABLE IF NOT EXISTS `hpi_navigation_trees` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM;
