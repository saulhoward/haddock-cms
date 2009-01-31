<?php
/**
 * Content of the "db-page" page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$page_row = $gvm->get('page-row');

/*
 * Edit button if an admin user is logged in.
 */

$content_div->append_str_to_content($page_row->get_html_content());

echo $content_div->get_as_string();

?>
