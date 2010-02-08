<?php
/**
 * HaddockProjectOrganisation_ProjectNameValidator
 *
 * @copyright 2008-06-02, RFI
 */

class
	HaddockProjectOrganisation_ProjectNameValidator
extends
	InputValidation_Validator
{
	public function
		validate($name)
	{
		return $this->validate_pattern(
			$name,
			'/^[-a-z0-9]+$/',
			'The project name must be all lower case letters, digits or hyphens!'
		);
	}
}
?>