<?php
/**
 * Content of the "edit-user" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Create the Singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

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
 * Fetch the user to be edited.
 */
$user = $gvm->get('user');
$user_renderer = $user->get_renderer();

/*
 * The form.
 */
$content_div->append_tag_to_content(
    $user_renderer->get_edit_user_form()
);

echo $content_div->get_as_string();

?>

