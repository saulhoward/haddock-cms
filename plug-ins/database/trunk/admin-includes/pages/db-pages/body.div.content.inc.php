<?php
/**
 * Content of the "db-pages" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Fetch the database objects.
 */
$pages_table = $gvm->get('pages-table');
$pages_table_renderer = $gvm->get('pages-table-renderer');

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Links to pages where the user can do things.
 */
$page_options_div = new HTMLTags_Div();
$page_options_div->set_attribute_str('id', 'page-options');

$page_options_ul = new HTMLTags_UL();

/*
 * Add a new page.
 */
$add_new_page_li = new HTMLTags_LI();

$add_new_page_a = new HTMLTags_A('Add new page');

$add_new_page_href = new HTMLTags_URL();

$add_new_page_href->set_file('/');

$add_new_page_href->set_get_variable('section', 'haddock');
$add_new_page_href->set_get_variable('module', 'admin');
$add_new_page_href->set_get_variable('page', 'admin-includer');
$add_new_page_href->set_get_variable('type', 'html');
$add_new_page_href->set_get_variable('admin-section', 'haddock');
$add_new_page_href->set_get_variable('admin-module', 'database');
$add_new_page_href->set_get_variable('admin-page', 'add-new-db-page');

$add_new_page_a->set_href($add_new_page_href);

$add_new_page_li->append_tag_to_content($add_new_page_a);

$page_options_ul->add_li($add_new_page_li);

/*
 * Delete all pages.
 */
$delete_all_pages_li = new HTMLTags_LI();

$delete_all_pages_a = new HTMLTags_A('Delete all pages');

$delete_all_pages_href = new HTMLTags_URL();

$delete_all_pages_href->set_file('/');

$delete_all_pages_href->set_get_variable('section', 'haddock');
$delete_all_pages_href->set_get_variable('module', 'admin');
$delete_all_pages_href->set_get_variable('page', 'admin-includer');
$delete_all_pages_href->set_get_variable('type', 'html');
$delete_all_pages_href->set_get_variable('admin-section', 'haddock');
$delete_all_pages_href->set_get_variable('admin-module', 'database');
$delete_all_pages_href->set_get_variable('admin-page', 'delete-all-pages-page');

$delete_all_pages_a->set_href($delete_all_pages_href);

$delete_all_pages_li->append_tag_to_content($delete_all_pages_a);

$page_options_ul->add_li($delete_all_pages_li);

$page_options_div->append_tag_to_content($page_options_ul);

$content_div->append_tag_to_content($page_options_div);

/*
 * The pages list.
 */
$content_div->append_tag_to_content(
    $pages_table_renderer->get_admin_pages_html_table()
);

echo $content_div->get_as_string();

?>

