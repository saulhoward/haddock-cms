<?php
/**
 * The redirect script commands for the user
 * management page in the database admin section.
 *
 * @copyright Clear Line Web Design, 2007-01-29
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

if (isset($_GET['create_db_user'])) {
    session_start();
    
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    
    $root_mysql_user =
        $mysql_user_factory->get_root_user_for_this_project();
        
    if (!$root_mysql_user->has_user_for_this_project()) {
        $root_mysql_user->create_user_for_this_project();
    }
}
?>
