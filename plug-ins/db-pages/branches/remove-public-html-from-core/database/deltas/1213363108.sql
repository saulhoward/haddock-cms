-- Delta file for the Db Pages module
-- (c) 2008-06-13, Robert Impey

CREATE TABLE `hpi_db_pages_text_section_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE = MYISAM ;
