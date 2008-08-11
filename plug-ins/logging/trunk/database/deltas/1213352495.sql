-- Delta file for the Logging module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE hc_logging_server_logs (
  id int(10) unsigned NOT NULL auto_increment,
  remote_addr varchar(255) NOT NULL,
  session_id varchar(255) default NULL,
  visited datetime NOT NULL,
  request_uri text NOT NULL,
  http_referer text NOT NULL,
  http_user_agent text NOT NULL,
  referer_domain_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
