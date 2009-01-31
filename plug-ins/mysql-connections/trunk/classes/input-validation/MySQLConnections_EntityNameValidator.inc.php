<?php
/**
 * MySQLConnections_EntityNameValidator
 *
 * @copyright 2009-01-31, RFI
 */

/*
 * The database's name and the user's name must match the same
 * regular expression.
 * Therefore, that code is shared between them in this class.
 */
abstract class
	MySQLConnections_EntityNameValidator
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