<?php
/**
 * A script to add, update and delete
 * rows in the paypal_settings table in the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-03-02
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

/*
 * Make a table object to access the table.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$paypal_settings_table = $database->get_table('hpi_shop_paypal_settings');

/*
 * Set the default return to page.
 */
$return_to = '/admin/?module=shop&page=paypal_settings';

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
    $paypal_settings_table->delete_by_id($_GET['delete_id']);
    $return_to .= '&last_deleted_id=' . $_GET['delete_id'];
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {
    
    $return_to .= '&deleted_all=successful';
}

# Add a new row to the table.
if (isset($_GET['add_row'])) {
    
        #print_r($_POST);
                        
        $last_added_id = $paypal_settings_table->add_paypal_setting(
            $_POST['name'],
            $_POST['iso_639_1_code']
        );
    
        $return_to .= '&last_added_id=' . $last_added_id;

}


# Update a project in the database.
if (isset($_GET['edit_id'])) {
    $paypal_settings_table->edit_paypal_setting(
        $_GET['edit_id'],
        $_POST['name'],
            $_POST['iso_639_1_code']
   );
    $return_to .= '&last_edited_id=' . $_GET['edit_id'];
}
?>
