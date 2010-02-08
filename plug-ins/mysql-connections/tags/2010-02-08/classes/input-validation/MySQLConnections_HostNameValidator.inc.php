<?php
/**
 * MySQLConnections_HostNameValidator
 *
 * @copyright 2009-01-31, Robert Impey
 */

class
	MySQLConnections_HostNameValidator
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