<?php
/**
 * Logging_Logger
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

class
    Logging_Logger
{
    public function
        __construct()
    {
    }
    
    public function
        log()
    {
        #echo "Logging...\n";
        
        $mysql_user_factory = Database_MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_project();
        $database = $mysql_user->get_database();
        
        $server_logs_table = $database->get_table('hc_logging_server_logs');
        
        $server_logs_table->add_log_entry(
            $_SERVER['REMOTE_ADDR'],
            session_id(),
            'NOW()',
            $_SERVER['REQUEST_URI'],
            $_SERVER['HTTP_REFERER'],
            $_SERVER['HTTP_USER_AGENT'],
            $_SERVER['HTTP_HOST']
        );
    }
}
?>
