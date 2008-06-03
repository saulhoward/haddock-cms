<?php
/**
 * ServerAdminScripts_MySQLDumpsDownloadingRemoteServerValidator
 *
 * @copyright 2008-06-03, RFI
 */

class
	ServerAdminScripts_MySQLDumpsDownloadingRemoteServerValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return $this->validate_pattern(
			$string,
			'/^\S+$/',
			'Remote servers must not contain white space!'
		);
	}
}
?>