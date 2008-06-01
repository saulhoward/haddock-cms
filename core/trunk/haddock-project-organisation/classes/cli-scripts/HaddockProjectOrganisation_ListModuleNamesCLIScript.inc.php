<?php
/**
 * HaddockProjectOrganisation_ListModuleNamesCLIScript
 *
 * @copyright 2008-05-29, RFI
 */

class
	HaddockProjectOrganisation_ListModuleNamesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		$module_names_aoa = array();
		
		foreach (
			$project_directory->get_module_directories()
			as
			$module_directory
		) {
			$module_names_aoa[]
				= array(
					'identifying_name' => $module_directory->get_identifying_name(),
					#'module_name' => $module_directory->get_module_name(),
					'camel_case_root' => $module_directory->get_camel_case_root(),
					'title' => $module_directory->get_title()
				);
		}
		
		CLIScripts_DataRenderingHelper
			::render_array_of_assocs_in_table($module_names_aoa);
	}
}
?>