-- Delta file for the News module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_news_items` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `submitted` datetime NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `item` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
