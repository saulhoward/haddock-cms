<?php
/**
 * HTMLTags_Select
 *
 * @copyright 2006-11-27, RFI
 */
	
class
	HTMLTags_Select
extends
	HTMLTags_TagWithContent
implements
	HTMLTags_InputTag
{
	private $options;
	
	public function
		__construct(
			$content = NULL
		)
	{
		parent::__construct('select', $content);
		
		$this->options = array();
	}
	
	public function
		append_str_to_content($str)
	{
		throw new Exception(
			'Attempt to append a string to the content of a HTMLTags_Select!'
		);
	}
	
	public function
		append_tag_to_content(HTMLTags_Tag $tag)
	{
		throw new Exception(
			'Attempt to append a tag to the content of a HTMLTags_Select!'
		);
	}
	
	/**
	 * Allows the coder to add an option to this select.
	 *
	 * What if the value of the option hasn't been set?
	 * That's still valid HTML.
	 */
	public function
		add_option(
			HTMLTags_Option $option
		)
	{
		$attribute = $option->get_attribute('value');
		
		/*
		 * What's this line for?
		 */
		$attribute->get_value();
		
		$this->options[$attribute->get_value()] = $option;
	}
	
	protected function
		get_options()
	{
		return $this->options;
	}
	
	public function
		set_value($value)
	{
		#echo 'print_r($this->options)' . "\n";
		#print_r($this->options);
		
		if (array_key_exists($value, $this->options)) {
			foreach (array_keys($this->options) as $key) {
				$this->options[$key]->remove_attribute('selected');
			}
			
			$this->options[$value]->set_attribute_str('selected');
		} else {
			throw new HTMLTags_ValueNotSetInSelectException(
				$value
			);
		}
	}
	
	public function
		get_content()
	{
		$content = new HTMLTags_TagContent();
		
		foreach ($this->get_options() as $option) {
			$content->append_tag($option);
		}
		
		return $content;
	}
}
?>