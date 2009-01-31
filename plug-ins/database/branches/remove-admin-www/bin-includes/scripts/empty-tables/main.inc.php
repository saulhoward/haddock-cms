<?php
/**
 * The main .INC for the empty-tables script.
 *
 * @copyright Clear Line Web Design, 2007-09-19
 */

/*
 * Create the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

foreach ($database->get_tables() as $table) {
    if (!$silent) {
        echo 'Emptying ' . $table->get_name() . "\n";
    }
    
    $table->delete_all();
}
?>
