CREATE TABLE `hpi_feed_aggregator_feeds` (
    `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `description` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `url` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `format` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL
) ENGINE = MYISAM ;
