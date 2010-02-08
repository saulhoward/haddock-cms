<?php
/**
 * HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator
extends
	ObjectOrientation_UpperCamelCaseValidator
{
	protected function
		get_exception_message()
	{
		return 'Module directory camel case roots must be upper camel case!';
	}
}
?>