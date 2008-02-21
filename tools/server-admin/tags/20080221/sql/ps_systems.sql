-- Table structure for table 'ps_systems'
-- 
-- © Clear Line Web Design, 2007-04-27

CREATE TABLE ps_systems (
  id int(10) unsigned NOT NULL auto_increment,
  name varchar(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY name (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
