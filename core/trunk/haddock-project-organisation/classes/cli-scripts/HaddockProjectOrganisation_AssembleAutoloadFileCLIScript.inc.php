<?php
/**
 * HaddockProjectOrganisation_AssembleAutoloadFileCLIScript
 *
 * @copyright 2008-05-23, RFI
 */

class
	HaddockProjectOrganisation_AssembleAutoloadFileCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		
		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();
		
		$project_directory->refresh_autoload_file();
	}
}
?>