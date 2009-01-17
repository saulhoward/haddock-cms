<?php
/**
 * HTMLTags_FormWithInputs
 *
 * @copyright 2008-04-03, Robert Impey
 */

class
	HTMLTags_FormWithInputs
extends
	HTMLTags_Form
{
	private $inputs;
	private $hidden_inputs;
	
	public function
		__construct($content = NULL)
	{
		parent::__construct($content);
		
		$this->inputs = array();
		$this->hidden_inputs = array();
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the hidden inputs
	 * ----------------------------------------
	 */
	
	public function
		get_hidden_inputs()
	{
		return $this->hidden_inputs;
	}
	
	public function
		get_hidden_input($name)
	{
		return $this->hidden_inputs[$name];
	}
	
	public function
		add_hidden_input($name, $value)
	{
		#echo __METHOD__ . PHP_EOL; exit;
		
		#$this->hidden_inputs[$name] = new HTMLTags_Input();
		#
		#$this->hidden_inputs[$name]->set_attribute_str('type', 'hidden');
		#$this->hidden_inputs[$name]->set_attribute_str('name', $name);
		#$this->hidden_inputs[$name]->set_attribute_str('value', $value);
		
		$this->add_hidden_input_obj(new HTMLTags_HiddenInput($name, $value));
	}
	
	public function
		add_hidden_input_obj(
			HTMLTags_HiddenInput $hidden_input
		)
	{
		$this->hidden_inputs[$hidden_input->get_value_of_attribute('name')] = $hidden_input;
	}
}
?>