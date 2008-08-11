<?php
/**
 * A script to add, update and delete
 * rows in a database table according to the settings in an XML file.
 *
 * @copyright Clear Line Web Design, 2007-11-03
 */

#print_r($_GET); exit;

/*
 * Create the XML DB page manager.
 */
if (isset($_GET['db-xml-file'])) {
	/*
	 * Create the singleton objects.
	 */
	$page_manager = PublicHTML_PageManager::get_instance();
	$svm = Caching_SessionVarManager::get_instance();

	$xml_db_page_manager 
		= new Database_AdminXMLPageManager(
			$_GET['db-xml-file'],
			$_GET['db-section'],
			$_GET['db-module']
		);

	/*
	 * Create the database objects.
	 */
	$table = $xml_db_page_manager->get_table();

	/*
	 * Get the base return to page.
	 */
#	$return_to_url = 
#		= Admin_AdminIncluderURLFactory
#			::get_url(
#				'haddock', 
#				'database', 
#				'table-xml', 
#				'html'
#			);
#
#	$return_to_url->set_get_variable('db-section', $_GET['db-section']); 
#
#	if (isset($_GET['db-module'])) {
#		$return_to_url->set_get_variable('db-module', $_GET['db-module']);
#	}
#	
#	$return_to_url->set_get_variable('xml-file', $xml_db_page_manager->get_xml_file_name());

	
	$return_to_url = new HTMLTags_URL();
	$return_to_url->set_file('/');

	foreach (array_keys($_GET) as $get_key) {
		$return_to_url->set_get_variable($get_key, $_GET[$get_key]);
	}
	
	$return_to_url->set_get_variable('type', 'html');
		
	#print_r($return_to_url); exit;

	/*
	 * Are we cancelling?
	 */
	
#	print_r($_GET); #exit;

	if (isset($_GET['cancel'])) {
#		echo "cancel set\n"; #exit;

		$svm->delete_matching('/^table-xml: /');
		
		$return_to_url->unset_get_variable('cancel');
		
		foreach (explode(' ', 'delete_all delete_id add_row edit_id') as $key) {
			if ($return_to_url->is_get_variable_set($key)) {
				$return_to_url->unset_get_variable($key);
			}
		}
	} else {
		/*
		 * Make alterations to the table.
		 */
		
#		echo "cancel not set.\n"; exit;

		try {
			/*
			 * Add to the table.
			 */
			if (isset($_GET['add_row'])) {
				#print_r($_POST); exit;

				$id = $xml_db_page_manager->add($table, $_POST, $_FILES); 
				$return_to_url->unset_get_variable('add_row');
				$return_to_url->set_get_variable('last_added_id', $id);
			}
				
			/*
			 * Update the table.
			 */
			if (isset($_GET['edit_id'])) {
				$xml_db_page_manager->update_by_id(
					$table,
					$_GET['edit_id'],
					$_POST,
					$_FILES
				);
				$return_to_url->unset_get_variable('edit_id');
				$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
			}

			/*
			 * Delete rows from the database.
			 */
			if (isset($_GET['delete_id'])) {
				$xml_db_page_manager->delete_by_id($table, $_GET['delete_id']);
				$return_to_url->unset_get_variable('delete_id');
				$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
			}

			if (isset($_GET['delete_all'])) {
				$xml_db_page_manager->delete_all($table);
				$return_to_url->unset_get_variable('delete_all');
				$return_to_url->set_get_variable('all_rows_deleted');
			}
		} catch (Exception $e) {
			$return_to_url->set_get_variable('error', urlencode($e->getMessage()));
		}
	}
	
	/*
	 * Set the return to URL.
	 */
	$page_manager->set_return_to_url($return_to_url);
} else {
	throw new Exception('The DB XML file must be set!');
}
?>
