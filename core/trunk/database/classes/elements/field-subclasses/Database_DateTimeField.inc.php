<?php
/**
 * Database_DateTimeField
 *
 * @copyright 2006-09-21, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/field-subclasses/'
#    . 'Database_TemporalField.inc.php';

/**
 * A class to represent a datetime field
 * in a database table.
 */
class
	Database_DateTimeField
extends
	Database_TemporalField
{
	public function
		get_assignment_clause($value)
	{
		$assignment_clause = ' ';
		
		$assignment_clause .= $this->get_name();
		
		$assignment_clause .= ' = ';
		
		/*
		 * Is this a literal value or a function?
		 */
		if (preg_match('/^(?:[A-Z_]+\(.*?\))$/', $value)) {
			$assignment_clause .= $value;
		} else {
			$assignment_clause .= '"' . $value . '"';
		}
		
		$assignment_clause .= ' ';
		
		return $assignment_clause;
	}
	
	public function
		get_equals_clause($value)
	{
		$equals_clause = ' ';
		
		$equals_clause .= $this->get_name();
		
		$equals_clause .= ' = \'';
		
		$equals_clause .= $value;
		
		$equals_clause .= '\' ';
		
		return $equals_clause;
	}
}
?>