<?php
/**
 * HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
{
	public static function
		get_project_specific_directory()
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		return
			$project_directory
				->get_project_specific_directory();
	}
}
?>