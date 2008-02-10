<?php
/**
 * The content of the page for signing in as the root MySQL user.
 *
 * @copyright Clear Line Web Design, 2007-01-28
 */

/*
 * -----------------------------------------------------------------------------
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_SimpleOLForm.inc.php';

/*
 * -----------------------------------------------------------------------------
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Make sure that a password file for
 * this project exists.
 *
 * If there isn't such a file, provide a link
 * to the page where the user can create one.
 */
$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$project_specific_directory
    = $project_directory->get_project_specific_directory();
    
if (!$project_specific_directory->has_passwords_file()) {
    $demand_pw_f_p = new HTMLTags_P();
    $demand_pw_f_p->set_attribute_str('class', 'error');
    
    $demand_pw_f_p->append_str_to_content(
        'This project doesn\'t have a passwords file yet!'
    );
    
    $content_div->append_tag_to_content($demand_pw_f_p);

    $create_pw_f_p = new HTMLTags_P();
    
    $create_pw_f_p->append_str_to_content(
        'Click '
    );
    
    $create_pw_f_a = new HTMLTags_A('here');
    
    $create_pw_f_url = new HTMLTags_URL(
        '/admin/database/passwords-file-management.html'
    );
    
    $create_pw_f_a->set_href($create_pw_f_url);
    
    $create_pw_f_p->append_tag_to_content($create_pw_f_a);
    
    $create_pw_f_p->append_str_to_content(
        ' to create one.'
    );
    
    $content_div->append_tag_to_content($create_pw_f_p);
} else {
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    
    $root_mysql_user =
        $mysql_user_factory->get_root_user_for_this_project();
    
    if (!$root_mysql_user->has_password()) {
        $root_password_form = new HTMLTags_SimpleOLForm('root_password');
        
        $r_p_f_action_url = new HTMLTags_URL();
        $r_p_f_action_url->set_file('/admin/redirect-script.php');
        $r_p_f_action_url->set_get_variable('module', 'database');
        $r_p_f_action_url->set_get_variable('page', 'sign-in-as-root');
        
        $root_password_form->set_action($r_p_f_action_url);
        
        $password_file = $root_mysql_user->get_password_file();
        
        $root_password_form->set_legend_text(
            'Root Password for ' . $password_file->get_host()
        );
        
        #$root_password_form->add_input_name('password');
        $password_tag = new HTMLTags_Input();
        
        $password_tag->set_attribute_str('type', 'password');
        $password_tag->set_attribute_str('id', 'password');
        $password_tag->set_attribute_str('name', 'password');
        
        $root_password_form->add_input_tag(
            'password',
            $password_tag,
            'Password'
        );
        
        $root_password_form->set_submit_text('Sign In');
        
        $root_password_form->set_cancel_location(
            new HTMLTags_URL('/admin/database/home.html')
        );
        
        $content_div->append_tag_to_content($root_password_form);
    } else {
        /*
         * Make sure that the root can log on to
         * the database set in the passwords file
         * using the password from the session variable.
         */
        
        if (!$root_mysql_user->can_log_on()) {
            $root_mysql_user->clear_password();
            
            $wrong_pw_p = new HTMLTags_P();
            $wrong_pw_p->set_attribute_str('class', 'error');
            
            $wrong_pw_p->append_str_to_content(
                'The MySQL root password was not accepted!'
            );
            
            $content_div->append_tag_to_content($wrong_pw_p);
            
            /*
             * -----------------------------------------------------------------
             */
            
            $enter_r_pw_p = new HTMLTags_P();
            
            $enter_r_pw_p->append_str_to_content(
                'Click '
            );
            
            $enter_r_pw_a = new HTMLTags_A('here');
            
            $enter_r_pw_url = new HTMLTags_URL(
                '/admin/database/sign-in-as-root.html'
            );
            
            $enter_r_pw_a->set_href($enter_r_pw_url);
            
            $enter_r_pw_p->append_tag_to_content($enter_r_pw_a);
            
            $enter_r_pw_p->append_str_to_content(
                ' to try again.'
            );
            
            $content_div->append_tag_to_content($enter_r_pw_p);
        } else {
            /*
             * A link to sign out.
             */
            #print_r($_SESSION);
            
            $root_pw_status_p = new HTMLTags_P();
            
            $root_pw_status_p->append_str_to_content(
                'The root password has been entered.'
            );
            
            $content_div->append_tag_to_content($root_pw_status_p);
        
            $sign_out_p = new HTMLTags_P();
            
            $sign_out_p->append_str_to_content(
                'Click '
            );
            
            $sign_out_a = new HTMLTags_A('here');
            
            $sign_out_url = new HTMLTags_URL();
            
            $sign_out_url->set_file('/admin/redirect-script.php');
            $sign_out_url->set_get_variable('module', 'database');
            $sign_out_url->set_get_variable('page', 'sign-in-as-root');
            $sign_out_url->set_get_variable('sign_out');
            
            $sign_out_a->set_href($sign_out_url);
            
            $sign_out_p->append_tag_to_content($sign_out_a);
            
            $sign_out_p->append_str_to_content(
                ' to sign out.'
            );
            
            $content_div->append_tag_to_content($sign_out_p);
        }
    }
}

/*
 * -----------------------------------------------------------------------------
 */

echo $content_div;
?>
