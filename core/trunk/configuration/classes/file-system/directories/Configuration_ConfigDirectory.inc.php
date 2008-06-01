<?php
/**
 * Configuration_ConfigDirectory
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_ConfigDirectory
extends
	#HaddockProjectOrganisation_StandardModuleSubDirectory
	FileSystem_Directory
{
	public function
		get_all_config_files()
	{
		$config_files = array();
		
		foreach (
			$this->get_files_by_extension_recursively('xml')
			as
			$xml_file
		) {
			$config_files[]
				= new Configuration_ConfigFile(
					$xml_file->get_name()
				);
		}
		
		return $config_files;
	}
}
?>