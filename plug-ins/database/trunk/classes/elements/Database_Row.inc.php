<?php
/**
 * Database_Row
 * 
 * @copyright 2006-09-07, Robert Impey
 */

/**
 * A generic class to represent any type of row in a database table.
 *
 * This class should be subclassed.
 *
 * Some of the code that extends this class is being slowly replaced
 * with the extensions to the <code>Persistence_Entry</code>.
 */
class
	Database_Row
extends
	Database_Element
{
	###############
	# The members #
	###############
	
	private $table;
	protected $field_values;
	
	###################
	# The Constructor #
	###################
	
	public function
		__construct(
			$table,
			$field_values
		)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\n";
			
			echo 'print_r($table): ' . "\n";
			print_r($table);
			
			echo 'print_r($field_values): ' . "\n";
			print_r($field_values);
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$this->table = $table;
		$this->field_values = $field_values;
	}
	
	###################################
	# Access and mutate this instance #
	###################################
	
	public function
		get_table()
	{
		return $this->table;
	}
	
	public function
		get_database()
	{
		$table = $this->get_table();
		return $table->get_database();
	}
	
	public function
		get($field_name)
	{
		$table = $this->get_table();

		if (!$table->has_field($field_name)) {
			$table_name = $table->get_name();
			throw new Database_FieldNotInTableException($table_name, $field_name);
		}
		
		$field = $table->get_field($field_name);
		
		return $field->process_value($this->field_values[$field_name]);
	}
	
	public function
		set($field_name, $value)
	{
		$table = $this->get_table();
		$table_name = $table->get_name();
		
		if (!$table->has_field($field_name)) {
			throw new Database_FieldNotInTableException($table_name, $field_name);
		}
		
		$this->field_values[$field_name] = $value;
	}
	
	public function
		commit()
	{
		$values = null;
		
		foreach (array_keys($this->field_values) as $field_name) {
			$values[$field_name] = $this->field_values[$field_name];
		}
		
		#echo __LINE__ . "\n";
		#print_r($values);
		
		$table = $this->get_table();
		$table->update_by_id($this->get_id(), $values);
	}
	
	/**
	 * The primary key of all our tables
	 * must be called 'id'.
	 *
	 * This is fine for everything that we have done
	 * so far but can we imagine a table where
	 * this wouldn't be a good idea?
	 *
	 * e.g. A very simple table with just two columns
	 * that are foreign keys that represents a many-to-many
	 * relationship between to tables.
	 */
	public function
		get_id()
	{
		return $this->get('id');
	}
	
	####################
	# Renderer Methods #
	####################
	
	#public function get_renderer_subclass_name()
	#{
	#    $table = $this->get_table();
	#    $renderer_class_name = $table->get_row_class_name();
	#    $renderer_class_name .= 'Renderer';
	#    
	#    return $renderer_class_name;
	#}
	#
	#public function get_renderer_subclass_filename()
	#{
	#    $renderer_class_directory = PROJECT_ROOT . '/classes/database/renderers/row-renderers/';
	#        
	#    $renderer_class_filename = $renderer_class_directory
	#        . $this->get_renderer_subclass_name() . '.inc.php';
	#    
	#    #echo "$renderer_class_filename\n";
	#    
	#    return $renderer_class_filename;
	#}
	#
	#public function has_renderer_subclass()
	#{
	#    return file_exists($this->get_renderer_subclass_filename());
	#}
	#
	#public function get_renderer_class_filename()
	#{
	#    if ($this->has_renderer_subclass()) {
	#        #echo "has renderer subclass!\n";
	#        
	#        return $this->get_renderer_subclass_filename();
	#    } else {
	#        #echo "doesn't have renderer subclass!\n";
	#        
	#        return CLWD_CORE_ROOT . '/database/renderers/RowRenderer.inc.php';
	#    }
	#}
	#
	#public function get_renderer_class_name()
	#{
	#    if ($this->has_renderer_subclass()) {
	#        return $this->get_renderer_subclass_name();
	#    } else {
	#        return 'RowRenderer';
	#    }
	#}
	#
	#public function declare_renderer_class()
	#{
	#    $renderer_class_name = $this->get_renderer_class_filename();
	#    require_once $renderer_class_name;
	#}
	#
	#public function get_renderer_class()
	#{
	#    $this->declare_renderer_class();
	#    
	#    $renderer_class_name = $this->get_renderer_class_name();
	#    
	#    return new ReflectionClass($renderer_class_name);
	#}
	
	/**
	 * If a renderer class for this has been implemented
	 * and saved in the row subclass renderers directory,
	 * then that class will be returned.
	 *
	 * Otherwise, the default row renderer (which the
	 * row subclass renderers should extend anyway)
	 * is returned.
	 */
	public final function
		get_renderer()
	{
		#$renderer_class = $this->get_renderer_class();
		#return $renderer_class->newInstance($this);
		
		$table = $this->get_table();
		
		$table_name = $table->get_name();
		
		$database_class_factory = Database_DatabaseClassFactory::get_instance();
		
		$row_renderer_class
			= $database_class_factory->get_row_renderer_class($table_name);
		
		$renderer = $row_renderer_class->newInstance($this);
		
		return $renderer;
	}
	
	public function
		get_database_handle()
	{
		$database = $this->get_database();
		return $database->get_database_handle();
	}
	
	public function
		get_cell($field_name)
	{
		$table = $this->get_table();
		
		$field = $table->get_field($field_name);
		
		return new Database_Cell($field, $this->get($field_name));
	}
}

?>