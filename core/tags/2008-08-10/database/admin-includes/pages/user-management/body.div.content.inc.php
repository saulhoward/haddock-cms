<?php
/**
 * The content of the page for user management
 * in the database admin section.
 *
 * @copyright Clear Line Web Design, 2007-01-29
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';
    
/*
 * -----------------------------------------------------------------------------
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Make sure that a password file exists.
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
    /*
     * Make sure that the root password
     * has been entered by the user and has
     * been saved in a session variable.
     */
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    
    $root_mysql_user =
        $mysql_user_factory->get_root_user_for_this_project();
    
    if (!$root_mysql_user->has_password()) {
        $demand_r_pw_p = new HTMLTags_P();
        $demand_r_pw_p->set_attribute_str('class', 'error');
        
        $demand_r_pw_p->append_str_to_content(
            'The MySQL root password hasn\'t been entered yet!'
        );
        
        $content_div->append_tag_to_content($demand_r_pw_p);
        
        /*
         * ---------------------------------------------------------------------
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
            ' to enter it.'
        );
        
        $content_div->append_tag_to_content($enter_r_pw_p);
    } else {
        /*
         * Does a database with the name set in the passwords
         * file exist already?
         */
        if (!$root_mysql_user->has_database()) {
            $db_not_yet_p = new HTMLTags_P();
            $db_not_yet_p->set_attribute_str('class', 'error');
            
            $db_not_yet_p->append_str_to_content(
                'The database for this project does not exist yet!'
            );
            
            $content_div->append_tag_to_content($db_not_yet_p);
            
            /*
             * -----------------------------------------------------------------
             */
           
            $create_db_p = new HTMLTags_P();
            
            $create_db_p->append_str_to_content(
                'Click '
            );
            
            $create_db_a = new HTMLTags_A('here');
            
            $create_db_url = new HTMLTags_URL(
                '/admin/database/database-creation.html'
            );
            
            $create_db_a->set_href($create_db_url);
            
            $create_db_p->append_tag_to_content($create_db_a);
            
            $create_db_p->append_str_to_content(
                ' to create it.'
            );
            
            $content_div->append_tag_to_content($create_db_p);
        } else {
            /*
             * If a MySQL user for this project has not yet been created,
             * ask the user if they want to create one now.
             */
            if (!$root_mysql_user->has_user_for_this_project()) {
                $db_user_not_yet_p = new HTMLTags_P();
                $db_user_not_yet_p->set_attribute_str('class', 'error');
                
                $db_user_not_yet_p->append_str_to_content(
                    'The database user for this project does not exist yet!'
                );
                
                $content_div->append_tag_to_content($db_user_not_yet_p);
                
                /*
                 * -------------------------------------------------------------
                 */
               
                $create_db_user_p = new HTMLTags_P();
                
                $create_db_user_p->append_str_to_content(
                    'Click '
                );
                
                $create_db_user_a = new HTMLTags_A('here');
                
                $create_db_user_url = new HTMLTags_URL();
                $create_db_user_url->set_file('/admin/redirect-script.php');
                $create_db_user_url->set_get_variable('module', 'database');
                $create_db_user_url->set_get_variable('page', 'user-management');
                $create_db_user_url->set_get_variable('create_db_user');
                
                $create_db_user_a->set_href($create_db_user_url);
                
                $create_db_user_p->append_tag_to_content($create_db_user_a);
                
                $create_db_user_p->append_str_to_content(
                    ' to create it.'
                );
                
                $content_div->append_tag_to_content($create_db_user_p);
            } else {
                $db_user_already_p = new HTMLTags_P();
                
                $db_user_already_p->append_str_to_content(
                    'The database user for this project exists.'
                );
                
                $content_div->append_tag_to_content($db_user_already_p);
            }
        }
    }
}

/*
 * -----------------------------------------------------------------------------
 */

echo $content_div;
?>
