-- Schema for the hpi_db_pages_edits table.
--
-- @copyright RFI 2007-12-15

CREATE TABLE `hpi_db_pages_edits` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(10) unsigned NOT NULL,
  `text_id` int(10) unsigned NOT NULL,
  `submitted` datetime NOT NULL,
  `current` enum('Yes','No') character set ascii collate ascii_bin NOT NULL default 'No',
  `deleted` enum('Yes','No') character set ascii collate ascii_bin NOT NULL default 'No',
  PRIMARY KEY  (`id`)
) ENGINE = MYISAM ;
