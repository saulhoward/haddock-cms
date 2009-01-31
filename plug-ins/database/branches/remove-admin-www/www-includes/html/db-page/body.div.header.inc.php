<?php
/**
 * Prints the header for a DB page.
 *
 * @copyright Clear Line Web Desgin, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'header');

$page_row = $gvm->get('page-row');

$content_div->append_str_to_content($page_row->get_title());

echo $content_div->get_as_string();
?>
