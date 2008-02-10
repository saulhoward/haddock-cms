CREATE TABLE IF NOT EXISTS `hpi_navigation_nodes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `url_id` int(11) unsigned NOT NULL,
  `tree_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned default NULL,
  `sort_order` int(11) unsigned NOT NULL,
  `added` datetime NOT NULL,
  `open_in_new_window` enum('Yes','No') character set ascii collate ascii_bin NOT NULL default 'No',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;