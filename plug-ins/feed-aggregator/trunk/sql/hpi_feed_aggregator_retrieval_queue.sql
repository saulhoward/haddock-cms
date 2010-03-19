CREATE TABLE `hpi_feed_aggregator_retrieval_queue` (
    `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `feed_id` INT( 10 ) UNSIGNED NOT NULL ,
    `frequency_minutes` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL ,
    `last_retrieved` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_roman_ci NULL ,
    `status` ENUM( 'retrieve', 'skip' ) NOT NULL DEFAULT 'skip'
) ENGINE = MYISAM ;
