<?php
/**
 * HaddockProjectOrganisation_AutoloadFilesHelper
 *
 * @copyright 2008-05-23, RFI
 */

class
	HaddockProjectOrganisation_AutoloadFilesHelper
{
	public static function
		refresh_autoload_file()
	{
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();

		$project_directory->refresh_autoload_file();
	}
}
?>