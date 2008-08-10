-- Table structure for table of images.
--
-- @copyright Clear Line Web Design, 2006-11-07

CREATE TABLE hc_database_images (
  id int(10) unsigned NOT NULL auto_increment,
  file_type varchar(255) NOT NULL default '',
  image longblob NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM ;
