<?php
/**
 * ObjectOrientation_HelperNameValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	ObjectOrientation_HelperNameValidator
extends
	HaddockProjectOrganisation_HaddockClassNameValidator
{
	protected function
		get_class_name_stem()
	{
		return 'Helper';
	}
}
?>