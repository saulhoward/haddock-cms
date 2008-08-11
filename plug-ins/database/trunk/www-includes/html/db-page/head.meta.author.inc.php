<?php
/**
 * Gets the author for a db-page.
 *
 * @copyright Clear Line Web Desgin, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

$page_row = $gvm->get('page-row');
$page_row_renderer = $gvm->get('page-row-renderer');

$author_meta_tag = $page_row_renderer->get_author_meta_tag();

echo $author_meta_tag->get_as_string();
?>
