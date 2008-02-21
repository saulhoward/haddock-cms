<?php
/**
 * Content of the log in page.
 *
 * @copyright Clear Line Web Design, 2007-08-06
 */

$admin_login_manager = Admin_LoginManager::get_instance();

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

if ($admin_login_manager->is_logged_in()) {
    $content_div->append_tag_to_content(new HTMLTags_P('You are already logged in.'));
} else {
    if (isset($_SESSION['admin-login-data']['error-message'])) {
        $error_p = new HTMLTags_P($_SESSION['admin-login-data']['error-message']);
        
        $error_p->set_attribute_str('class', 'error');
        
        $content_div->append_tag_to_content($error_p);
    }
    
    $content_div->append_tag_to_content(
        $admin_login_manager->get_login_form_div(
            isset($_SESSION['admin-login-data']['name'])
            ? $_SESSION['admin-login-data']['name'] : NULL
        )
    );
}

echo $content_div->get_as_string();
?>
