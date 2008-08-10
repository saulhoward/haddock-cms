<?php
/**
 * The commands that are carried out by the redirect
 * script of  the Database Creation page in the
 * database admin section.
 * 
 * @copyright Clear Line Web Design, 2007-01-28
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

if (isset($_GET['create_db'])) {
    session_start();
    
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    
    $root_mysql_user =
        $mysql_user_factory->get_root_user_for_this_project();
        
    if (!$root_mysql_user->has_database()) {
        $root_mysql_user->create_database();
    }
}
?>
