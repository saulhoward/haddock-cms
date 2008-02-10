-- Table structure for table 'hpi_db_pages_texts'
-- 
-- @copyright RFI 2007-12-15

CREATE TABLE `hpi_db_pages_texts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `checksum` varchar(255) character set ascii collate ascii_bin NOT NULL,
  `filter_function_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
