-- Table structure for table 'ps_task_events'
-- 
-- © Clear Line Web Design, 2007-04-27

CREATE TABLE ps_task_events (
  id int(10) unsigned NOT NULL auto_increment,
  host_id int(10) unsigned NOT NULL,
  task_id int(10) unsigned NOT NULL,
  system_id int(10) unsigned NOT NULL,
  `start` datetime NOT NULL default '0000-00-00 00:00:00',
  finish datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
