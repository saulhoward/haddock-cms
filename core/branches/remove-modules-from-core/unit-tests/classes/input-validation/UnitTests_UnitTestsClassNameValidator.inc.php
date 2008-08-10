<?php
/**
 * UnitTests_UnitTestsClassNameValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	UnitTests_UnitTestsClassNameValidator
extends
	HaddockProjectOrganisation_HaddockClassNameValidator
{
	protected function
		get_class_name_stem()
	{
		return 'UnitTests';
	}
}
?>