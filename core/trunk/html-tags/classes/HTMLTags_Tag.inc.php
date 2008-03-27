<?php
/**
 * HTMLTag_Tag
 *
 * @copyright 2006-11-27, RFI
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_BareAttribute.inc.php';
#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_AttributeWithValue.inc.php';

/**
 * One class to rule them all and in the darkness render them.
 */
abstract class
	HTMLTags_Tag
{
	/**
	 * e.g. 'a', 'p', etc.
	 */
	private $name;
	
	private $attributes;
	
	protected function __construct($name)
	{
		$this->name = $name;
		$this->attributes = array();
	}
	
	public function get_name()
	{
		return $this->name;
	}
	
	/**
	 * Should anything happen if that attribute has
	 * already been set?
	 */
	public function set_attribute(HTMLTags_Attribute $attribute)
	{
		$this->attributes[$attribute->get_name()] = $attribute;
	}
	
	public function set_attribute_str($name, $value = null)
	{
		if (isset($value)) {
			$attribute = new HTMLTags_AttributeWithValue($name, $value);
		} else {
			$attribute = new HTMLTags_BareAttribute($name);
		}
		
		$this->set_attribute($attribute);
	}
	
	public function get_attributes()
	{
		return $this->attributes;
	}
	
	public function has_attribute($attribute_name)
	{
		return isset($this->attributes[$attribute_name]);
	}
	
	public function get_attribute($attribute_name)
	{
		if ($this->has_attribute($attribute_name)) {
			return $this->attributes[$attribute_name];
		} else {
			$error_message = "$attribute_name not set in this " . $this->get_name() . ' tag!';
			
			throw new Exception($error_message);
		}
	}
	
	public function remove_attribute($attribute_name)
	{
		if (isset($this->attributes[$attribute_name])) {
			unset($this->attributes[$attribute_name]);
		}
	}
	
	public function count_attributes()
	{
		return count($this->attributes);
	}
	
	protected static function get_required_attributes()
	{
		return array();
	}
	
	protected function get_attribute_string()
	{
		$attribute_string = '';
		
		if ($this->count_attributes() > 0) {
			# Check that the required attributes are set.
			$required_attributes = self::get_required_attributes();
			$attributes = $this->get_attributes();
			
			foreach ($required_attributes as $required_attribute) {
				if (!array_key_exists($required_attribute, $attributes)) {
					
					$reflection_class = new ReflectionObject($this);
					$error_message = "$required_attribute must be set in ";
					$error_message .= $reflection_class->getName();
					
					throw new Exception($error_message);
				}
			}
			
			$attribute_string .= "\n";
			
			foreach ($this->get_attributes() as $attribute) {
				$attribute_string .= '  ';
				
				$attribute_string .= $attribute->get_as_string();
				
				$attribute_string .= "\n";
			}
		}
		
		return $attribute_string;
	}
	
	abstract public function get_as_string();
	
	public function __toString()
	{
		return $this->get_as_string();
	}
	
	public function
		get_pre_opening_tag_comment()
	{
		return '';
	}
	
	public function
		get_post_closing_tag_comment()
	{
		return '';
	}
}
?>