-- Delta file for the Shop module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_shop_commenters` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `url` varchar(255) NOT NULL,
  `homepage_title` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `joined` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
