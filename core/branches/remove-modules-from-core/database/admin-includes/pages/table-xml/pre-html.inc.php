<?php
/**
 * Pre-display code for the XML database table page.
 * 
 * Sets variables (order by, direction, offset, limit) for
 * fetching rows from the database.
 *
 * @copyright Clear Line Web Design, 2007-11-02
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Create the XML DB page manager.
 */
if (isset($_GET['db-xml-file'])) {
	$xml_db_page_manager 
		= new Database_AdminXMLPageManager(
			$_GET['db-xml-file'],
			$_GET['db-section'],
			$_GET['db-module']
		);
	
	if (isset($_GET['order_by'])) {
		$xml_db_page_manager->set_current_order_by($_GET['order_by']);
	}	

	if (isset($_GET['direction'])) {
		$xml_db_page_manager->set_current_direction($_GET['direction']);
	}	

	if (isset($_GET['offset'])) {
		$xml_db_page_manager->set_current_offset($_GET['offset']);
	}	

	if (isset($_GET['limit'])) {
		$xml_db_page_manager->set_current_limit($_GET['limit']);
	}	

	$gvm->set('xml_db_page_manager', $xml_db_page_manager);
} else {
	throw new Exception('The DB XML file must be set!');
}

?>
