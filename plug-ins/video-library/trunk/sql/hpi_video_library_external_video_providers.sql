CREATE TABLE `hpi_video_library_external_video_providers` (
`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
`url` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
`haddock_class_name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL
) ENGINE = MYISAM ;
