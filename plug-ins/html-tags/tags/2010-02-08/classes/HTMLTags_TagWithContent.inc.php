<?php
/**
 * HTMLTags_TagWithContent
 *
 * @copyright 2006-11-27, Robert Impey
 */

abstract class
	HTMLTags_TagWithContent
extends
	HTMLTags_Tag
{
	private $content;
	
	protected function
		__construct(
			$name,
			$content
		)
	{
		parent::__construct($name);
		
		$this->content = new HTMLTags_TagContent();
		
		if (isset($content)) {
			$this->content->append_str($content);
		}
	}
	
	protected function
		get_content()
	{
		return $this->content;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with appending things to the content.
	 * ----------------------------------------
	 */
	
	public function
		append_str_to_content($str)
	{
		$this->content->append_str($str);
	}

	public function
		append_tag_to_content(
			HTMLTags_Tag $tag
		)
	{
		$this->content->append_tag($tag);
	}
	
	/**
	 * I sometimes wish that I were writing Java...
	 */
	public function
		append($appendage)
	{
		if (is_a($appendage, 'HTMLTags_Tag')) {
			$this->append_tag_to_content($appendage);
		} else {
			$this->append_str_to_content($appendage);
		}
	}
	
	protected function
		get_opening_tag()
	{
		$opening_tag = '<' . $this->get_name();
		
		$opening_tag .= $this->get_attribute_string();
		
		$opening_tag .= '>';
		
		return $opening_tag;
	}
	
	protected function
		get_closing_tag()
	{
		return '</' . $this->get_name() . ">\n";
	}
	
	public function
		get_tag_string()
	{
		$string = '';
		
		/*
		 * Open the tag.
		 */
		$string .= $this->get_opening_tag();
		
		/*
		 * The content
		 */
		$content = $this->get_content();
		$string .= $content->get_as_string();
		
		/*
		 * Close the tag.
		 */
		$string .= $this->get_closing_tag();
		
		return $string;
	}
}
?>