-- Delta file for the Logging module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE hc_logging_referer_domains (
  id int(10) unsigned NOT NULL auto_increment,
  domain varchar(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY domain (domain)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
