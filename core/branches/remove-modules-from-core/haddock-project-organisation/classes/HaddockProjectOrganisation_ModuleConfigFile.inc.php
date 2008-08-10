<?php
/**
 * HaddockProjectOrganisation_ModuleConfigFile
 *
 * @copyright 2007-01-23, RFI
 */

#require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_DataFile.inc.php';

class
	HaddockProjectOrganisation_ModuleConfigFile
extends
	FileSystem_DataFile
{
	public function
		has_admin_section_title()
	{
		return $this->has_value_for('admin-section-title', '=');
	}
	
	public function get_admin_section_title()
	{
		return $this->get_value_for('admin-section-title', '=');
	}
	
	public function
		has_camel_case_root()
	{
		return $this->has_value_for('camel-case-root', '=');
	}
	
	public function get_camel_case_root()
	{
		return $this->get_value_for('camel-case-root', '=');
	}
	
	public function
		has_module_name()
	{
		return $this->has_value_for('module-name', '=');
	}
	
	public function get_module_name()
	{
		return $this->get_value_for('module-name', '=');
	}
}
?>