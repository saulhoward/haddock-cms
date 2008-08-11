-- Table structure for table 'ignored_hosts'
--
-- © Clear Line Web Design, 2007-04-05

CREATE TABLE hc_logging_ignored_hosts (
  id int(10) unsigned NOT NULL auto_increment,
  referer_domain_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
