<?php
/**
 * The redirect script for adding server log
 * file to the server_logs table.
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$server_logs_table = $database->get_table('hc_logging_server_logs');

if (isset($_GET['add_log_file'])) {
    $server_logs_table->add_log_file($_FILES['user_file']['tmp_name'][0]);
}
?>
