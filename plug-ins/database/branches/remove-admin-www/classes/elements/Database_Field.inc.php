<?php
/**
 * Database_Field
 *
 * @copyright 2006-09-17, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/'
#	. 'Database_Element.inc.php';

/**
 * Represents a field or column in a table.
 *
 * Instances of this class are NOT used to
 * store values of fields from a row.
 */
class
	Database_Field
extends
	Database_Element
{
	private $table;
	private $name;
	private $type;
	private $can_be_null;
	private $key;
	private $default;
	private $extra;
	
	public function
		__construct(
			$table,
			$name,
			$type,
			$can_be_null,
			$key,
			$default,
			$extra
		)
	{
		$this->table = $table;
		$this->name = $name;
		$this->type = $type;
		$this->can_be_null = $can_be_null;
		$this->key = $key;
		$this->default = $default;
		$this->extra = $extra;
	}
	
	public function
		get_database()
	{
		$table = $this->get_table();
		
		return $table->get_database();
	}
	
	public function
		get_table()
	{
		return $this->table;
	}
	
	public function
		get_name()
	{
		return $this->name;
	}
	
	public function
		set_name($field_name)
	{
		$this->name = $field_name;
	}
	
	/**
	 * Used with queries involving joins.
	 */
	public function
		get_table_name_dot_field_name()
	{
		if (preg_match('/^\w+\.\w+$/', $this->name)) {
			return $this->name;
		} elseif (preg_match('/^(\w+)__(\w+)$/', $this->name, $match)) {
			return $matches[1] . '.' . $matches[2];
		} else {
			$table_name_dot_field_name = '';
			
			$table_name_dot_field_name .= $this->table->get_name();
			
			$table_name_dot_field_name .= '.';
			
			$table_name_dot_field_name .= $this->get_name();
			
			return $table_name_dot_field_name;
		}
	}

	public function
		get_type()
	{
		return $this->type;
	}

	public function
		can_be_null()
	{
		#return isset($this->can_be_null);
		return $this->can_be_null == 'YES';
	}

	public function
		get_key()
	{
		return $this->key;
	}

	public function
		get_default()
	{
		return $this->default;
	}
	
	public function
		has_default()
	{
		return isset($this->default);
	}

	public function
		get_extra()
	{
		return $this->extra;
	}
	
	public final function
		get_renderer()
	{
		$table = $this->get_table();
		
		$table_name = $table->get_name();
		
		$database_class_factory
			= Database_DatabaseClassFactory::get_instance();
		
		$field_renderer_class
			= $database_class_factory->get_field_renderer_class(
				$table_name,
				$this->get_name()
			);
		
		$renderer = $field_renderer_class->newInstance($this);
		
		return $renderer;
	}
	
	public function
		get_assignment_clause($value)
	{
		$assignment_clause = ' ';
		
		$assignment_clause .= $this->get_name();
		
		$assignment_clause .= ' = ';
		
		$assignment_clause .= $value;
		#$assignment_clause .= addslashes($value);
		
		$assignment_clause .= ' ';
		
		#echo "\$assignment_clause: $assignment_clause\n";
		
		return $assignment_clause;
	}
	
	public function
		get_equals_clause($value)
	{
		return $this->get_assignment_clause($value);
	}
	
	public function
		process_value($value)
	{
		return $value;
	}
	
	public function
		validate_value($value)
	{
		return TRUE;
	}
}
?>