<?php
/**
 * Database_DatabaseValidator
 *
 * @copyright 2008-05-27, RFI
 */

abstract class
	Database_EntityNameValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return $this->validate_pattern(
			$string,
			'/^[a-z0-9_]+$/',
			'The ' . $this->get_entity_name() . ' must be all lowercase letters, digits or underscores!'
		);
	}
	
	abstract protected function
		get_entity_name();
}
?>