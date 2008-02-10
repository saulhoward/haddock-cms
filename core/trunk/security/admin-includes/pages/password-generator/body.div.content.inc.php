<?php
/**
 * The Password Generator Page.
 *
 * @copyright Clear Line Web Design, 2007-01-26
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Pre.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_SimpleOLForm.inc.php';

require_once PROJECT_ROOT
    . '/haddock/security/classes/'
    . 'Security_PasswordGenerator.inc.php';

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

if (isset($_GET['length'])) {
    $password_p = new HTMLTags_P();

    $password_p->append_str_to_content('The password: ');
    
    $password_generator = Security_PasswordGenerator::get_instance();
    
    $password_p->append_tag_to_content(
        new HTMLTags_Pre(
            $password_generator->get_password($_GET['length'])
        )
    );
    
    $content_div->append_tag_to_content($password_p);
} else {
    $password_details_form
        = new HTMLTags_SimpleOLForm('password_details', 'GET');
    
    $action_url = new HTMLTags_URL('/admin/index.php');
    
    $password_details_form->set_action($action_url);
    
    $password_details_form->set_legend_text('Password Details');
    
    $password_details_form->add_input_name('length');
    
    $password_details_form->add_hidden_input('module', 'security');
    $password_details_form->add_hidden_input('page', 'password-generator');
    
    $password_details_form->set_submit_text('Go');
    
    $password_details_form->set_cancel_location(
        new HTMLTags_URL('/admin/security/home.html')
    );
    
    $content_div->append_tag_to_content($password_details_form);
}

echo $content_div->get_as_string();
?>
