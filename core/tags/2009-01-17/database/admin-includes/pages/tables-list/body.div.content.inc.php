<?php
/**
 * Lists the tables in the database for this site.
 *
 * @copyright 2006-09-21, Robert Impey
 */

#require_once PROJECT_ROOT . '/haddock/database/classes/Database_MySQLUserFactory.inc.php';

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
#print_r($mysql_user_factory);

$mysql_user = $mysql_user_factory->get_for_this_project();
#print_r($mysql_user);

$database = $mysql_user->get_database();
#print_r($database);

?>
<div id="content">
<h2>Tables in <?php echo $database->get_name(); ?></h2>

<p>
	<em>WARNING!</em>
	Editing the values of the table directly may lead
	to unforeseen consequences.
</p>
<?php

$database_renderer = $database->get_renderer();
$database_renderer->render_tables_list();
?>
</div>