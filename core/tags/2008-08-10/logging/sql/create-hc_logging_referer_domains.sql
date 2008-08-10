-- Table structure for table 'referer_domains'
-- 
-- © Clear Line Web Design, 2007-04-05

CREATE TABLE hc_logging_referer_domains (
  id int(10) unsigned NOT NULL auto_increment,
  domain varchar(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY domain (domain)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
