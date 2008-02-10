<?php
/**
 * The div where the user is thanked for submitting their email.
 *
 * @copyright Clear Line Web Design, 2007-07-13
 */

?>
<div
    id="thank_you"
>
<?php
echo 'Thank you';
    
if (isset($_SESSION['last_added_id'])) {
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_project();
    $database = $mysql_user->get_database();
    
    $people_table = $database->get_table('hpi_mailing_list_people');
    
    #$person_row = $people_table->get_row_by_id($_GET['last_added_id']);
    $person_row = $people_table->get_row_by_id($_SESSION['last_added_id']);
    
    $name = $person_row->get_name();
    
    echo ", $name.\n";
    
    unset($_SESSION['last_added_id']);
} else {
    echo ".\n";
}

?>
</div>
