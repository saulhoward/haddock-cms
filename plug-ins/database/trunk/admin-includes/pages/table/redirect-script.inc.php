<?php
/**
 * A script to add, update and delete
 * rows in a database table.
 *
 * @copyright 2006-11-21, Robert Impey
 */

#header('Content-type: text/plain');
#echo "The GET variables: \n";
#print_r($_GET);
#echo "The POST variables: \n";
#print_r($_POST);
#exit;

/*
 * Check that the relevant GET vars have been set.
 */
if (!isset($_GET['table'])) {
	throw new Exception('No table set!');
}

/*
 * Create the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$table = $database->get_table($_GET['table']);

/*
 * Get the base return to page.
 */
#$return_to = '/admin/index.php?module=database&page=table&table=' . $table->get_name();
$return_to_url = $page_manager->get_return_to_url();

# If a file is being added.
#if (isset($_FILES['user_file'])) {
#    #print_r($_FILES);
#    
#    $size = getimagesize($_FILES['user_file']['tmp_name'][0]);
#    
#    $values['file_type'] = $size['mime'];
#    
#    $values['image'] = addslashes(file_get_contents($_FILES['user_file']['tmp_name'][0]));
#    #$values['image'] = file_get_contents($_FILES['user_file']['tmp_name'][0]);
#    
#    # Make a table object to access the table.
#    $table = $database->get_table($_GET['table']);
#    
#    #print_r($images_table);
#    
#    #if (!isset($_GET['return_to'])) {
#    #    $return_to .= 'tables/' . $images_table->get_name() . '.html';
#    #}
#    
#    $table->add($values);

/*
 * Add to or update the table.
 */
if (isset($_POST['add_image'])) {
	#echo "Adding an image\n";
	
	if (isset($_FILES['user_file'])) {
		$table->add_image_file($_FILES['user_file']);
	}
	
	$return_to_url->unset_get_variable('add_row');
} else {
	if (isset($_GET['add_row']) || isset($_GET['edit_id'])) {
		$fields = $table->get_fields();
		
		$values = array();
		
		foreach ($fields as $field) {
			#echo $field->get_name();
			
			if (isset($_POST[$field->get_name()])) {
				$values[$field->get_name()] = $_POST[$field->get_name()];
			}
		}
		
		# Add a new row to the table.
		if (isset($_GET['add_row'])) {
			$id = $table->add($values);
			
			$return_to_url->unset_get_variable('add_row');
		}
		
		# Update a project in the database.
		if (isset($_GET['edit_id'])) {
			$table->update_by_id($_GET['edit_id'], $values);
			
			$return_to_url->unset_get_variable('edit_id');
		}
	}
}

/*
 * Delete rows from the database.
 */
if (isset($_GET['delete_id'])) {
	$table->delete_by_id($_GET['delete_id']);
	
	$return_to_url->unset_get_variable('delete_id');
}

if (isset($_GET['delete_all'])) {
	$table->delete_all();
	
	$return_to_url->unset_get_variable('delete_all');
}

/*
 * Set the return to URL.
 */
$page_manager->set_return_to_url($return_to_url);
?>