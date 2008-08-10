<?php
/**
 * Database_RowOLForm
 *
 * @copyright 2006-12-02, Robert Impey
 */

abstract class
	Database_RowOLForm
extends
	HTMLTags_SimpleOLForm
{
	private $table;
	
	public function
		__construct(
			Database_Table $table,
			$form_name
		)
	{
		parent::__construct($form_name);
		
		$this->table = $table;
	}
	
	public function
		get_table()
	{
		return $this->table;
	}
	
	abstract public function
		add_hidden_fields_str($hidden_fields_str);
	
	public function
		get_visible_fields()
	{
		$table = $this->get_table();
		
		$fields = $table->get_fields();
		
		$hidden_inputs = $this->get_hidden_inputs();
		
		$hidden_input_names = array_keys($hidden_inputs);
		
		$visible_fields = array();
		
		foreach ($fields as $field) {
			if (!in_array($field->get_name(), $hidden_input_names)) {
				$visible_fields[] = $field;
			}
		}
		
		return $visible_fields;
	}
	
	protected function
		get_input_lis()
	{
		$msg = <<<MSG
Method get_input_lis() must be overriden in a
sub-class of Database_RowOLForm!
MSG;

		throw new Exception($msg);
	}
}
?>