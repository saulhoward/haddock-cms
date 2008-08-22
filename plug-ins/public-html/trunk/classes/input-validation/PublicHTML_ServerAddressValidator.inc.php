<?php
/**
 * PublicHTML_ServerAddressValidator
 */

class
	PublicHTML_ServerAddressValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return
			$this->validate_pattern(
				$string,
				$regex = '{https?://[/\w-]+}',
				$exception_message = 'Malformed server address!'
			);
	}
}
?>