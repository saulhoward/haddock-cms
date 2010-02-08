<?php
/**
 * HaddockProjectOrganisation_StandardModuleSubDirectory
 *
 * @copyright 2008-05-30, RFI
 */

/**
 * Represents a sub-directory of a module directory that
 * is standard in the sense that several modules might have
 * the same directory.
 *
 * e.g. 'config', 'classes', 'public-html'
 */
abstract class
	HaddockProjectOrganisation_StandardModuleSubDirectory
extends
	FileSystem_Directory
{
	private $module_directory;
	
	public function
		__construct(
			$name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		parent::__construct($name);
		
		$this->module_directory = $module_directory;
	}
	
	public function
		get_module_directory()
	{
		return $this->module_directory;
	}
}
?>