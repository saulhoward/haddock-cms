<?php
/**
 * The content of the admin page to manage users.
 *
 * @copyright Clear Line Web Design, 2007-08-26
 */

/*
 * Create the Singleton objects.
 */
$login_manager = Admin_LoginManager::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Create the database objects.
 */
$users_table = $login_manager->get_users_table();
$users_table_renderer = $users_table->get_renderer();

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

$add_new_user_li = new HTMLTags_LI();

$add_new_user_a = new HTMLTags_A('Add new user');

$add_new_user_href = Admin_AdminIncluderURLFactory
    ::get_url(
        'haddock',
        'admin',
        'add-new-user',
        'html'
    );

$add_new_user_a->set_href($add_new_user_href);

$add_new_user_li->append_tag_to_content($add_new_user_a);

$page_options_ul->add_li($add_new_user_li);

$page_options_div->append_tag_to_content($page_options_ul);

$content_div->append_tag_to_content($page_options_div);

/*
 * The users list.
 */

$current_page_url = Admin_AdminIncluderURLFactory
    ::get_url(
        'haddock',
        'admin',
        'manage-users',
        'html'
    );

#$actions_method_args[] = $current_page_url;

$content_div->append_tag_to_content(
    $users_table_renderer->get_admin_database_selection_html_table(
        $gvm->get('order_by'),
        $gvm->get('direction'),
        $gvm->get('offset'),
        $gvm->get('limit'),
        $current_page_url,
        'name email real_name type',
        'Admin Users',
        'get_admin_users_admin_actions'
    )
);

echo $content_div->get_as_string();
?>