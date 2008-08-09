<?php
/**
 * HaddockProjectOrganisation_ProjectSpecificDataHelper
 *
 * @copyright 2008-07-11, Robert Impey
 */

/**
 * A collection of functions to do with data that is
 * specific to a project.
 *
 * For example, the data used by the navigation plug-in
 * for creating HTML navigation lists on a site will
 * not change from instance to instance of a site.
 * The development version of the site needs the same
 * navigation lists as the testing version as the
 * production version.
 * This data is project-specific data.
 */
class
	HaddockProjectOrganisation_ProjectSpecificDataHelper
{
	/**
	 * Fetches the directory object for the module with
	 * the matching name.
	 *
	 * Each module and plug-in should store its project-specific data
	 * in its own directory.
	 * This function returns that directory.
	 *
	 * @param string $module_name The identifying name of the module.
	 */
	public static function
		get_directory($module_name)
	{
		if (
			HaddockProjectOrganisation_ModuleDirectoriesHelper
				::insist_module_directory_exists($module_name)
		) {
			$project_specific_directory
				= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
					::get_project_specific_directory();
			
			$directory_name
				= $project_specific_directory->get_name()
					. DIRECTORY_SEPARATOR . 'data'
					. DIRECTORY_SEPARATOR . $module_name;
			
			FileSystem_DirectoryHelper::mkdir_parents($directory_name);
			
			return new FileSystem_Directory($directory_name);
		}
	}
}
?>