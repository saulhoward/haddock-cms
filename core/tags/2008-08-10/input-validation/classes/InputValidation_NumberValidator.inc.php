<?php
/**
 * InputValidation_NumberValidator
 *
 * @copyright 2008-02-05, RFI
 */

class
	InputValidation_NumberValidator
{
	/**
	 * Checks that a variable has the form of an ID for
	 * a row in a database table.
	 */
	public static function
		validate_database_id($id)
	{
		if (!isset($id)) {
			throw new InputValidation_InvalidInputException('Database ID\'s must be set!');
		}
		
		$id = trim($id);
		
		if (strlen($id) < 1) {
			throw new InputValidation_InvalidInputException('Database ID\'s must be set!');
		}
		
		if (!is_numeric($id)) {
			throw new InputValidation_InvalidInputException("'$id' is not a numeric database ID!");
		}
		
		if ($id < 1) {
			throw new InputValidation_InvalidInputException("'$id' is less than one so it can't be a database ID!");
		}
		
		if (!preg_match('/^[0-9]+$/', $id)) {
			throw new InputValidation_InvalidInputException("'$id' is not an integer so it can't be a database ID!");
		}
		
		return TRUE;
	}
}
?>