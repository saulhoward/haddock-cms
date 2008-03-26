<?php
/**
 * OrderedTables_ReorderTableAdminPage
 *
 * @copyright 2008-03-14, RFI
 */

/**
 * This is the page where the user is shown the rows in the table
 * that are to be reordered.
 *
 * Links are rendered next to the rows which can be clicked to shift
 * the row up or down.
 */
class
	OrderedTables_ReorderTableAdminPage
extends
	Admin_RestrictedHTMLPage
{
	public function
		content()
	{
		if (isset($_GET['xml_config_file'])) {
			$xml_config_file
				= OrderedTables_ReorderTableAdminPageConfigFileFactory
					::make_xml_config_file_from_server($_GET['xml_config_file']);
			
			#echo __METHOD__ . "\n";
			#print_r($xml_config_file);
			
			#$xml_config_file_name = PROJECT_ROOT . $_GET['xml_config_file'];
			
			#if (file_exists($xml_config_file_name)) {
				OrderedTables_ReorderTableAdminPageHelper
					#::render_content_for_xml_file($xml_config_file_name);
					::render_content_for_xml_file($xml_config_file);
			#} else {
			#	throw new Exception("Unable to find $xml_config_file_name!");
			#}
		} else {
			throw new Exception('The XML config file must be set!');
		}
	}
}
?>