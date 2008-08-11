<?php
/**
 * A form for adding a new user.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Create the Singleton objects.
 */
$login_manager = Admin_LoginManager::get_instance();

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
 * Error messages.
 */
if (isset($_GET['error_message'])) {
    $error_message_div = new HTMLTags_LastActionBoxDiv(
        $message = stripslashes(urldecode($_GET['error_message'])),
        $no_script_href = '',
        $status = 'error'
    );
    
    $content_div->append_tag_to_content($error_message_div);
}

/*
 * The form.
 */
$content_div->append_tag_to_content(
    $users_table_renderer->get_add_new_user_form()
);

echo $content_div->get_as_string();
?>
