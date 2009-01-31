<?php
/**
 * Gets the title for a db-page.
 *
 * @copyright Clear Line Web Desgin, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

$page_row = $gvm->get('page-row');
$page_row_renderer = $gvm->get('page-row-renderer');

$title_tag = $page_row_renderer->get_title_tag();

echo $title_tag->get_as_string();
?>
