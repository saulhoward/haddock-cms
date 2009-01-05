-- Schema for the hpi_db_pages_text_section_links table.
--
-- @copyright RFI 2007-12-15

CREATE TABLE `hpi_db_pages_text_section_links` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `text_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE = MYISAM ;
