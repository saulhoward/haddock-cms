<?php
/**
 * Database_HostNameValidator
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_HostNameValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return $this->validate_pattern(
			$string,
			'/^[.\w]+$/',
			'Invalid host name!'
		);
	}
}
?>