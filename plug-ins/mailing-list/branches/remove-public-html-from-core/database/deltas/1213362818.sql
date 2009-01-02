-- Delta file for the Mailing List module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_mailing_list_people` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `email` varchar(255) character set utf8 collate utf8_roman_ci NOT NULL,
  `added` datetime NOT NULL,
  `status` enum('new','moderation','spam','accepted') character set utf8 collate utf8_roman_ci NOT NULL default 'new',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
