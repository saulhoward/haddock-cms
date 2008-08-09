<?php
/**
 * HTMLTags_FormActionAttribute
 *
 * @copyright 2008-04-04, Robert Impey
 */

class
	HTMLTags_FormActionAttribute
extends
	HTMLTags_AttributeWithValue
{
	private $url;
	
	public function
		__construct(
			HTMLTags_URL $url
		)
	{
		parent::__construct('action', NULL);
		
		$this->url = $url;
	}
	
	public function
		get_url()
	{
		return $this->url;
	}
	
	public function
		set_url(
			HTMLTags_URL $url
		)
	{
		$this->url = $url;
	}
	
	public function
		get_value()
	{
		$url = $this->get_url();
		
		return $url->get_as_string();
	}
	
	public function
		set_value($value)
	{
		$url = HTMLTags_URL::parse_and_make_url($value);
		
		$this->set_url($url);
	}
}
?>