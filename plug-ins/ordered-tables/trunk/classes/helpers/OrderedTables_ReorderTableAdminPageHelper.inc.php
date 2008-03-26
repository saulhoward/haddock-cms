<?php
/**
 * OrderedTables_ReorderTableAdminPageHelper
 *
 * @copyright 2008-03-18, RFI
 */

class
	OrderedTables_ReorderTableAdminPageHelper
{
	public static function
		render_content_for_xml_file(
			OrderedTables_ReorderTableAdminPageConfigFile $xml_config_file
		)
	{
		$rtad_manager
			= new OrderedTables_ReorderTableAdminPageManager($xml_config_file);
		
		$rtad_manager->render_content();
	}
}
?>