<?php
/**
 * The page where a web admin can add an existing log file.
 *
 * The file should be in Apache combined format.
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';
    
/*
 * Start the displayed content.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$server_logs_table = $database->get_table('hc_logging_server_logs');
$server_logs_table_renderer = $server_logs_table->get_renderer();

$log_file_adding_action = new HTMLTags_URL();

$log_file_adding_action->set_file('/admin/redirect-script.php');

$log_file_adding_action->set_get_variable('module', 'logging');
$log_file_adding_action->set_get_variable('page', 'add-log-file');
$log_file_adding_action->set_get_variable('add_log_file');

$log_file_adding_form
   = $server_logs_table_renderer->get_log_file_adding_form();

$log_file_adding_form->set_action($log_file_adding_action);

$cancel_href = new HTMLTags_URL();

$cancel_href->set_file('/admin/logging/home.html');

$log_file_adding_form->set_cancel_location($cancel_href);

$content_div->append_tag_to_content($log_file_adding_form);

echo $content_div->get_as_string();
?>
