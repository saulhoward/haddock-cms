<?php
/**
 * HTMLTags_Form
 *
 * @copyright 2006-11-27, Robert Impey
 */

class
	HTMLTags_Form
extends
	HTMLTags_TagWithContent
{
	private $action;
	#private $hidden_inputs;
	
	public function
		__construct($content = NULL)
	{
		parent::__construct('form', $content);
		
		#$this->hidden_inputs = array();
	}
	
	public function
		set_action(
			HTMLTags_URL $action
		)
	{
		#$this->set_attribute_str('action', $href->get_as_string());
		$this->action = $action;
	}
	
	public function
		get_action()
	{
		if (isset($this->action)) {
			return $this->action;
		} else {
			throw new Exception('The action attribute of a form must be set!');
		}
	}
	
	protected function
		get_required_attributes()
	{
		$required_attributes = parent::get_required_attributes();
		
		$required_attributes[] = 'action';
		
		return $required_attributes;
	}
	
	public function
		get_attributes()
	{
		$attributes = parent::get_attributes();
		
		$attributes['action'] = new HTMLTags_FormActionAttribute($this->get_action());
		
		return $attributes;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with hidden inputs.
	 *
	 * Should these be moved to the HTMLTags_FormWithInputs
	 * class?
	 * What would be broken?
	 * ----------------------------------------
	 */
	
	## No! No! No!
	## Use the delegate pattern?
	#public function
	#	get_hidden_inputs()
	#{
	#	return $this->hidden_inputs;
	#}
	#
	#public function
	#	add_hidden_input($name, $value)
	#{
	#	$this->hidden_inputs[$name] = new HTMLTags_Input();
	#	
	#	$this->hidden_inputs[$name]->set_attribute_str('type', 'hidden');
	#	$this->hidden_inputs[$name]->set_attribute_str('name', $name);
	#	$this->hidden_inputs[$name]->set_attribute_str('value', $value);
	#}
	
	/*
	 * Functions to do with a JS script tag that goes after the form.
	 * ----------------------------------------
	 */
}
?>