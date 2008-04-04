<?php
/**
 * HTMLTags_SimpleOLForm
 *
 * @copyright 2006-11-27, RFI
 */

/**
 * This extension to the standard form tag is intended
 * to remove some of the tedium and common errors of
 * writing forms in HTML.
 */
class
	HTMLTags_SimpleOLForm
extends
	HTMLTags_SimpleForm
{
	private $first_input_name;
	
	private $legend_text;
	private $legend;
	
	private $input_lis;
	
	private $submit_text;
	
	private $cancel_text;
	
	private $cancel_location;
	
	public function
		__construct(
			$name,
			$method = 'POST'
		)
	{
		parent::__construct('form', NULL);
		
		$this->set_attribute_str('name', $name);
		$this->set_attribute_str('method', $method);
		$this->set_attribute_str('class', 'basic-form');
		$this->set_attribute_str('id', 'basic-form');
		
		$this->input_lis = array();
	}
	
	public function
		append_str_to_content($str)
	{
		$msg = <<<MSG
Attempt to append a string to the content of a HTMLTags_SimpleOLForm!
MSG;

		throw new Exception($msg);
	}
	
	public function
		append_tag_to_content(HTMLTags_Tag $tag)
	{
		$msg = <<<MSG
Attempt to append a tag to the content of a HTMLTags_SimpleOLForm!
MSG;

		throw new Exception($msg);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the the legend
	 * ----------------------------------------
	 */
	
	public function
		get_legend_text()
	{
		if (isset($this->legend_text)) {
			return $this->legend_text;
		} else {
			throw new Exception('Legend text not set in SimpleOLForm!');
		}
	}
	
	public function
		set_legend_text($legend_text)
	{
		$this->legend_text = $legend_text;
	}
	
	protected function
		get_legend()
	{
		if (!isset($this->legend)) {
			$this->set_legend(
				new HTMLTags_Legend(
					$this->get_legend_text()
				)
			);
		}
		
		return $this->legend;
	}
	
	public function
		set_legend(
			HTMLTags_Legend $legend
		)
	{
		$this->legend = $legend;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the inputs
	 * ----------------------------------------
	 */
	
	public function
		add_input_tag(
			$name,
			HTMLTags_InputTag $input_tag,
			$label_text = NULL,
			$post_content = ''
		)
	{
		#echo "In HTMLTags_SimpleOLForm::add_input_tag(...)\n";
		
		$input_li = new HTMLTags_LI();
		
		if (!isset($label_text)) {
			$l_t_l_o_ws
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string(
						$name,
						'_'
					);
			
			$label_text = $l_t_l_o_ws->get_words_as_capitalised_string();
		#    echo "\$label_text: $label_text\n";
		#} else {
		#    echo "\$label_text: $label_text\n";
		}
		
		#echo "After if\n";
		
		$input_label = new HTMLTags_Label($label_text);
		$input_label->set_attribute_str('for', $name);
		#$input_label->set_attribute_str('id', $name);
		
		$input_li->append_tag_to_content($input_label);
		
		$input_li->append_tag_to_content($input_tag);
		
		if (strlen($post_content) > 0) {
			$input_li->append_str_to_content($post_content);
		}
		
		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', $name . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');
		
		$input_li->append_tag_to_content($input_msg_box);
		
		if (count($this->input_lis) == 0) {
			$this->first_input_name = $name;
		}
		
		$this->input_lis[] = $input_li;
	}

	public function
		add_input_li($input_li)
	{
		$this->input_lis[] = $input_li;
	} 

	public function
		add_input_name(
			$name,
			$label_text = NULL
		)
	{
		$input_tag = new HTMLTags_Input();
		
		$input_tag->set_attribute_str('type', 'text');
		$input_tag->set_attribute_str('id', $name);
		$input_tag->set_attribute_str('name', $name);
		
		$this->add_input_tag($name, $input_tag, $label_text);
	}
	
	public function
		add_input_name_with_value(
			$name,
			$value,
			$label_text = NULL
		)
	{
		$input_tag = new HTMLTags_Input();
		
		$input_tag->set_attribute_str('type', 'text');
		$input_tag->set_attribute_str('id', $name);
		$input_tag->set_attribute_str('name', $name);
		$input_tag->set_attribute_str('value', $value);
		
		$this->add_input_tag($name, $input_tag, $label_text);
	}
	
	protected function
		get_input_lis()
	{
		return $this->input_lis;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the submit button.
	 * ----------------------------------------
	 */
	
	public function
		set_submit_text($submit_text)
	{
		$this->submit_text = $submit_text;
	}
	
	protected function
		get_submit_text()
	{
		if (isset($this->submit_text)) {
			return $this->submit_text;
		} else {
			throw
				new Exception(
					'Submit text must be set in HTMLTags_SimpleOLForm!'
				);
		}
	}
	
	protected function
		get_submit_button()
	{
		$submit_button = new HTMLTags_Input();
		
		$submit_button->set_attribute_str('type', 'submit');
		$submit_button->set_attribute_str('value', $this->get_submit_text());
		$submit_button->set_attribute_str('class', 'submit');
		
		return $submit_button;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the cancel button.
	 * ----------------------------------------
	 */
	
	public function
		get_cancel_text()
	{
		if (isset($this->cancel_text)) {
			return $this->cancel_text;
		} else {
			return 'Cancel';
		}
	}
	
	public function 
		set_cancel_text($cancel_text)
	{
		$this->cancel_text = $cancel_text;
	}
	
	public function
		set_cancel_location(HTMLTags_URL $cancel_location)
	{
		$this->cancel_location = $cancel_location;
	}
	
	public function
		get_cancel_location()
	{
		if (isset($this->cancel_location)) {
			return $this->cancel_location;
		} else {
			throw
				new Exception(
					'Cancel location must be set in HTMLTags_SimpleOLForm!'
				);
		}
	}
	
	/**
	 * Returns the cancel button object.
	 *
	 * At the moment, this uses java script to move to the cancel location.
	 *
	 * Should just be a link.
	 */
	protected function
		get_cancel_button()
	{
		$cancel_button = new HTMLTags_Input();
		
		$cancel_location = $this->get_cancel_location();
		
		$onclick = 'document.location.href=(\'';
		$onclick .= $cancel_location->get_as_string();
		$onclick .= "')";
		
		$cancel_button->set_attribute_str('type', 'button');
		$cancel_button->set_attribute_str('value', $this->get_cancel_text());
		$cancel_button->set_attribute_str('onclick', $onclick);
		$cancel_button->set_attribute_str('class', 'submit');
		
		return $cancel_button;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the field set
	 * ----------------------------------------
	 */
	
	protected function
		get_field_set()
	{
		
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with putting the whole thing together.
	 * ----------------------------------------
	 */
	
	protected function
		get_required_attributes()
	{
		$required_attributes = parent::get_required_attributes();
		
		$required_attributes[] = 'name';
		$required_attributes[] = 'method';
		#$required_attributes[] = 'action';
		
		return $required_attributes;
	}
	
	protected function
		get_content()
	{
		$content = new HTMLTags_TagContent();
		
		/*
		 * The field set.
		 */
		$field_set = new HTMLTags_FieldSet();
		
		$field_set->append_tag_to_content($this->get_legend());
		
		$inputs_list = new HTMLTags_OL();
		
		$input_lis = $this->get_input_lis();
		
		if (count($input_lis) > 0) {
			foreach ($input_lis as $input_li) {
				$inputs_list->add_li($input_li);
			}
		} else {
			throw new Exception('No inputs set in HTMLTags_SimpleOLForm!');
		}
		
		$field_set->append_tag_to_content($inputs_list);
		
		$content->append_tag($field_set);
		
		/*
		 * The hidden inputs.
		 */
		
		foreach ($this->get_hidden_inputs() as $hidden_input) {
			$content->append_tag($hidden_input);
		}
		
		/*
		 * The buttons
		 */
		
		$submit_buttons_div = new HTMLTags_Div();
		$submit_buttons_div->set_attribute_str(
			'class',
			'submit_buttons_div'
		);
		
		$submit_buttons_div
			->append_tag_to_content($this->get_submit_button());
		
		$submit_buttons_div
			->append_tag_to_content($this->get_cancel_button());
		
		$content->append_tag($submit_buttons_div);
		
		return $content;
	}
	
	#public function
	#	get_as_string()
	#{
	#	$string = '';
	#	
	#	$string .= $this->get_opening_tag();
	#	$content = $this->get_content();
	#	$string .= $content->get_as_string();
	#	$string .= $this->get_closing_tag();
	#	
	#	#$script = new HTMLTags_Script();
	#	#
	#	#$script->set_attribute_str('type', 'text/javascript');
	#	#
	#	#$name_attribute = $this->get_attribute('name');
	#	#
	#	#$onload = "document.";
	#	#
	#	#$onload .= $name_attribute->get_value();
	#	#
	#	#$onload .= '.';
	#	#
	#	#$onload .= $this->first_input_name;
	#	#
	#	#$onload .= ".focus();";
	#	#
	#	#$script->append_str_to_content($onload);
	#	#
	#	#$string .= $script->get_as_string();
	#	
	#	return $string;
	#}
}
?>