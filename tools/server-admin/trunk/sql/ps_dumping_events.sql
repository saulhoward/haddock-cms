-- Table structure for table 'ps_dumping_events'
-- 
-- © Clear Line Web Design, 2007-04-29

CREATE TABLE ps_dumping_events (
  id int(10) unsigned NOT NULL,
  server_id int(10) unsigned NOT NULL,
  system_id int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  finish datetime NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
