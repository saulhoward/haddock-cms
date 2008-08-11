-- Delta file for the Database module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE hc_database_images (
  id int(10) unsigned NOT NULL auto_increment,
  file_type varchar(255) NOT NULL default '',
  image longblob NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM ;
