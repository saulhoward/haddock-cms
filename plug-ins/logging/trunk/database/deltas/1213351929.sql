-- Delta file for the Logging module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE hc_logging_ignored_hosts (
  id int(10) unsigned NOT NULL auto_increment,
  referer_domain_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
