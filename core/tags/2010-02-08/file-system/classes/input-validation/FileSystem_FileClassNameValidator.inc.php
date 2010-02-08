<?php
/**
 * FileSystem_FileClassNameValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_FileClassNameValidator
extends
	HaddockProjectOrganisation_HaddockClassNameValidator
{
	protected function
		get_class_name_stem()
	{
		return 'File';
	}
}
?>