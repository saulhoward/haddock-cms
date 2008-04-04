<?php
/**
 * Database_LimitForm
 *
 * @copyright 2008-02-19, RFI
 */

class
	Database_LimitForm
extends
	HTMLTags_FormWithInputs
{
	const default_limits_str = '10 20 50 100 250';
	
	private $current_limit;
	private $limits;
	
	public function
		__construct(
			HTMLTags_URL $action,
			$current_limit,
			$limits_str = NULL
		)
	{
		parent::__construct();
		
		$this->current_limit = $current_limit;
		#echo "\$this->current_limit: $this->current_limit\n"; exit;
		
		if (!isset($limits_str)) {
			$limits_str = self::default_limits_str;
		}
		
		if (preg_match('/^(?:\d+)(?: \d+)*$/', $limits_str)) {
			$this->limits = explode(' ', $limits_str);
		} else {
			throw new Exception('$limits_str must be like \'NUM[ NUM]*\'');
		}
		
		$this->set_attribute_str('name', 'limit_setting');
		$this->set_action($action);
		$this->set_attribute_str('method', 'GET');
		
		$select = new HTMLTags_Select();
		
		$select->set_attribute_str('name', 'limit');
		
		foreach ($this->limits as $limit) {
			$option = new HTMLTags_Option($limit);
			
			$option->set_attribute_str('value', $limit);
			
			$select->add_option($option);
		}
		
		$select->set_value($this->current_limit);
		
		$this->append_tag_to_content($select);
		
		foreach ($this->get_hidden_inputs() as $h_i) {
			$this->append_tag_to_content($h_i);
		}
		
		$submit = new HTMLTags_Input();
		$submit->set_attribute_str('type', 'submit');
		$submit->set_attribute_str('value', 'Go');
		
		$this->append_tag_to_content($submit);
		
		#$content->append_tag($p);
	}
	
	public function
		get_content()
	{
		$content = parent::get_content();
		
		foreach ($this->get_hidden_inputs() as $h_i) {
			$content->append_tag($h_i);
		}
		
		return $content;
	}
}
?>