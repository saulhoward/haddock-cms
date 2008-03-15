<?php
class
	OrderedTables_ReorderTableAdminPageHelper
{
	public static function
		render_content_for_xml_file($xml_config_file_name)
	{
		$rtad_manager
			= new OrderedTables_ReorderTableAdminPageManager(
				$xml_config_file_name
			);
			
	}
}
?>