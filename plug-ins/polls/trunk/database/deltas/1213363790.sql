-- Delta file for the Polls module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_polls_questions` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `question` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `current` enum('Yes','No') character set ascii collate ascii_bin NOT NULL default 'No',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
