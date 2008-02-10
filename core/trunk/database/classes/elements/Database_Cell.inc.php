<?php
/**
 * Database_Cell
 *
 * @copyright Clear Line Web Design, 2007-03-15
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_Element.inc.php';

/**
 * A class to represent a single cell in a database table.
 *
 * Not to be confused with a field.
 */
class
    Database_Cell
extends
    Database_Element
{
    private $field;
	private $value;
        
    public function 
		__construct(
			$field,
			$value
		)
	{
		$this->field = $field;
		$this->value = $value;
	}

	public function 
		get_field()
	{
		return $this->field;
	}

	public function 
		set_field(Database_Field $field)
	{
		$this->field = $field;
	}

	public function 
		get_value()
	{
		return $this->value;
	}

	public function 
		set_value($value)
	{
		$this->value = $value;
	}
    
    public function
        is_value_set()
    {
        return isset($this->value) && (strlen($this->value) > 0);
    }
}
?>
