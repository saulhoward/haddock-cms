-- Schema for hpi_db_pages_filter_functions
--
-- @copyright RFI 2007-12-15

CREATE TABLE `hpi_db_pages_filter_functions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `human_name` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `hpi_db_pages_filter_functions`
--
-- We need this list.

INSERT INTO `hpi_db_pages_filter_functions` (`id`, `name`, `human_name`) VALUES 
(1, 'DBPages_FilterHelper::blank_line_delimited_paragraphs', 'Blank Line Delimited Paragraphs'),
(2, 'stripcslashes', 'Strip Slashes');
