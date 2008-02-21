-- Table structure for table 'ps_tasks'
-- 
-- © Clear Line Web Design, 2007-04-30

CREATE TABLE ps_tasks (
  id int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
