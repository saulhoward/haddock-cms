<?php
/**
 * HaddockProjectOrganisation_CamelCaseRootValidator
 *
 * @copyright 2008-06-02, RFI
 */

class
	HaddockProjectOrganisation_CamelCaseRootValidator
extends
	InputValidation_Validator
{
	public function
		validate($camel_case_root)
	{
		return $this->validate_pattern(
			$camel_case_root,
			'/^(?:[A-Z0-9][a-z0-9]*)+$/',
			'The project camel case root must be in camel case!'
		);
	}
}
?>