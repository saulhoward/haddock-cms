CREATE TABLE `hpi_video_library_ext_vid_to_ext_vid_lib_links` (
	`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`external_video_id` INT( 10 ) UNSIGNED NOT NULL ,
	`external_video_library_id` INT( 10 ) NOT NULL
) ENGINE = MYISAM ;
