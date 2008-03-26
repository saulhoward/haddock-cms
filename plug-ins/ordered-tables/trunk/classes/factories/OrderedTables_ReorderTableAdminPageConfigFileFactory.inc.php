<?php
/**
 * OrderedTables_ReorderTableAdminPageConfigFileFactory
 *
 * @copyright 2008-03-19, RFI
 */

class
	OrderedTables_ReorderTableAdminPageConfigFileFactory
{
	public static function
		make_xml_config_file_from_server($server_file_name)
	{
		$absolute_file_name = PROJECT_ROOT . $server_file_name;
		
		$xml_config_file
			= new OrderedTables_ReorderTableAdminPageConfigFile($absolute_file_name);
		
		$xml_config_file->set_server_file_name($server_file_name);
		
		#print_r($xml_config_file);
		
		return $xml_config_file;
	}
}
?>