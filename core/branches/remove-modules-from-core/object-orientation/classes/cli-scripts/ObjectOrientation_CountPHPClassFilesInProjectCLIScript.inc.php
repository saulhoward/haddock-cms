<?php
/**
 * ObjectOrientation_CountPHPClassFilesInProjectCLIScript
 *
 * @copyright 2008-05-29, RFI
 */

class
	ObjectOrientation_CountPHPClassFilesInProjectCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		printf(
			'This project has %d PHP class files.' . PHP_EOL,
			count($php_class_files)
		);
	}
}
?>