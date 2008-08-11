<?php
/**
 * This script searches a project specific directory
 * for the password file for this server.
 *
 * If it finds it, the user can edit the current values.
 *
 * If it doesn't find it, the script suggests possible
 * values and, after the user confirms or edits these,
 * it writes them to a new password file.
 *
 * The values are written to file in the .INC file:
 *
 * redirect-script.inc.php
 *
 * in the same directory as this file.
 *
 * TO DO:
 * 
 * If changes are made to the file, the user can update
 * the values on the datebase if they have administrative
 * previleges.
 *
 * This should be done with a separate script.
 *
 * @copyright Clear Line Web Design, 2006-11-21
 */

/*
 * -----------------------------------------------------------------------------
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_SimpleOLForm.inc.php';

require_once PROJECT_ROOT
    . '/haddock/security/classes/'
    . 'Security_PasswordGenerator.inc.php';

/*
 * -----------------------------------------------------------------------------
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * -----------------------------------------------------------------------------
 */

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$project_specific_directory
    = $project_directory->get_project_specific_directory();

/*
 * -----------------------------------------------------------------------------
 */

if ($project_specific_directory->has_passwords_file()) {
    $p_f_already_p
        = new HTMLTags_P('This project already has a password file.');
    
    $content_div->append_tag_to_content($p_f_already_p);
    
    $passwords_file = $project_specific_directory->get_passwords_file();
    
    $host = $passwords_file->get_host();
    $username = $passwords_file->get_username();
    $database = $passwords_file->get_database();
    $password = $passwords_file->get_password();
} else {
    $p_f_not_yet_p
        = new HTMLTags_P('This project doesn\'t have a password file yet ...');
    
    $content_div->append_tag_to_content($p_f_not_yet_p);
    
    /*
     * The default host.
     */
    $host = 'localhost';
    
    /*
     * The username and database are suggested by the project directory.
     */
    $username = $project_directory->get_database_username_suggestion();
    $database = $project_directory->get_database_name_suggestion();
    
    /*
     * Generate a random password.
     */
    $password_length = 12;
    $password_generator = Security_PasswordGenerator::get_instance();
    $password = $password_generator->get_password($password_length);
}

/*
 * -----------------------------------------------------------------------------
 */

$password_management_form = new HTMLTags_SimpleOLForm('password_management');

$p_m_f_action_url = new HTMLTags_URL();
$p_m_f_action_url->set_file('/admin/redirect-script.php');
$p_m_f_action_url->set_get_variable('module', 'database');
$p_m_f_action_url->set_get_variable('page', 'passwords-file-management');

$password_management_form->set_action($p_m_f_action_url);

$password_management_form->set_legend_text('Password Management');

$password_management_form->add_input_name_with_value('host', $host);
$password_management_form->add_input_name_with_value('username', $username);
$password_management_form->add_input_name_with_value('database', $database);
$password_management_form->add_input_name_with_value('password', $password);

$password_management_form->set_submit_text('Commit');

$password_management_form->set_cancel_location(
    new HTMLTags_URL('/admin/database/home.html')
);

$content_div->append_tag_to_content($password_management_form);

/*
 * -----------------------------------------------------------------------------
 */

echo $content_div->get_as_string();
?>
