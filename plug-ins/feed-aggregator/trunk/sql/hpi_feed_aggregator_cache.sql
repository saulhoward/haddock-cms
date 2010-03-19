CREATE TABLE `hpi_feed_aggregator_cache` (
    `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `feed_id` INT( 10 ) UNSIGNED NOT NULL ,
    `date_retrieved` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `full_content` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `link` VARCHAR( 255 ) CHARACTER SET ucs2 COLLATE ucs2_roman_ci NOT NULL ,
    `updated` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `summary` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL
) ENGINE = MYISAM ;
