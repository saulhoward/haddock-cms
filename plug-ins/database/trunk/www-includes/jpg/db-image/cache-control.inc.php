<?php
/**
 * Cache control for the db-image page.
 *
 * @copyright Clear Line Web Design, 2007-09-18
 */

$gvm = Caching_GlobalVarManager::get_instance();

$cache_manager = Caching_CacheManager::get_instance();

$cache_manager->set_page_cacheability(TRUE);

$image = $gvm->get('image');

$cache_filename = PROJECT_ROOT
    . '/hc-database-img-cache/'
    . $image->get_id() . '.' . $image->get_file_extension();

$cache_manager->set_cache_filename($cache_filename);

?>
