-- Delta file for the Polls module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_polls_answers` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `question_id` int(11) unsigned NOT NULL,
  `answer` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;
