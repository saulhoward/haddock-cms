CREATE TABLE `hpi_video_library_external_videos` (
	`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`external_video_provider_id` INT( 10 ) UNSIGNED NOT NULL ,
	`providers_internal_id` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
	`providers_url` VARCHAR( 255 ) NOT NULL ,
	`thumbnail_url` VARCHAR( 255 ) NULL DEFAULT NULL
) ENGINE = MYISAM ;
