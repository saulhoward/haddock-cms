-- Table structure for table `hpi_trackit_stock_management_feed_files`
-- 

CREATE TABLE `hpi_trackit_stock_management_feed_files` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`created` datetime default NULL,
	`detected` datetime default NULL,
	`downloaded` datetime default NULL,
	`processed` datetime default NULL,
	`name` varchar(255) character set ascii NOT NULL,
	`file_type` enum('TXT','OTHER') character set ascii NOT NULL default 'TXT',
	`md5` varchar(255) character set ascii collate ascii_bin default NULL,
	PRIMARY KEY  (`id`),
	UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;