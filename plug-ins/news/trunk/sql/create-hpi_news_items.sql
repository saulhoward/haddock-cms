-- Table structure for table `hpi_news_items`
-- 

DROP TABLE IF EXISTS `hpi_news_items`;
CREATE TABLE `hpi_news_items` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `submitted` datetime NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `item` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;