<?php
/**
 * The main .INC for the create-image-cache-directory script.
 *
 * @copyright Clear Line Web Design, 2007-09-18
 */

$cache_dir_name = PROJECT_ROOT . '/hc-database-img-cache';

Caching_CacheDirectoryCreator
    ::create_cache_directory(
        $cache_dir_name,
        $restrict_access = FALSE,
        $silent
    );
?>
