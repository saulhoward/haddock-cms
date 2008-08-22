<?php
/**
 * Default cache control is to disable caching.
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

$gvm = Caching_GlobalVarManager::get_instance();
$cache_manager = Caching_CacheManager::get_instance();
$cache_manager->set_page_cacheability(TRUE);

?>
