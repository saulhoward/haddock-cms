<?php
/**
 * OrderedTables_ReorderTableAdminPage
 *
 * @copyright 2008-03-14
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
			$xml_config_file_name = PROJECT_ROOT . $_GET['xml_config_file'];
			
			if (file_exists($xml_config_file_name)) {
				OrderedTables_ReorderTableAdminPageHelper
					::render_content_for_xml_file($xml_config_file_name);
			} else {
				throw new Exception("Unable to find $xml_config_file_name!");
			}
		} else {
			throw new Exception('The XML config file must be set!');
		}
	}
}
?>