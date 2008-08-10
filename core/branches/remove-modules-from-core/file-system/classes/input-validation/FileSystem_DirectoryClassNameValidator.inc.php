<?php
/**
 * FileSystem_DirectoryClassNameValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_DirectoryClassNameValidator
extends
	HaddockProjectOrganisation_HaddockClassNameValidator
{
	protected function
		get_class_name_stem()
	{
		return 'Directory';
	}
}
?>