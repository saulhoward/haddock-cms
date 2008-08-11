<?php
/**
 * Database_PasswordValidator
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_PasswordValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return $this->validate_pattern(
			$string,
			'/^[^\s]{8,20}$/',
			'The password must be between 8 and 20 characters long and contain no whitespace!'
		);
	}
}
?>