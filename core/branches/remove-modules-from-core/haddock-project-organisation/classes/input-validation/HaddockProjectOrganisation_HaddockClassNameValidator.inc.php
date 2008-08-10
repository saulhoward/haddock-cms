<?php
/**
 * HaddockProjectOrganisation_HaddockClassNameValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

abstract class
	HaddockProjectOrganisation_HaddockClassNameValidator
extends
	ObjectOrientation_UpperCamelCaseValidator
{
	protected function
		get_exception_message()
	{
		return
			sprintf(
				'%s class names must be upper camel case!',
				$this->get_class_name_stem()
			);
	}
	
	abstract protected function
		get_class_name_stem();
}
?>