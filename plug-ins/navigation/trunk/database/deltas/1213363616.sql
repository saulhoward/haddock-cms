-- Delta file for the Navigation module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE IF NOT EXISTS `hpi_navigation_urls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `href` varchar(255) character set ascii collate ascii_bin NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `href` (`href`)
) ENGINE=MyISAM;
