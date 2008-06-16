-- Delta file for the Banner Ads module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_banner_ads_banner_ads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `embed` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
