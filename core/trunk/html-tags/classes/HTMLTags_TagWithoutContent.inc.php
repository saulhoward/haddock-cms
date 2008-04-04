<?php
/**
 * HTMLTags_TagWithoutContent
 *
 * @copyright 2006-11-27, RFI
 */

abstract class
	HTMLTags_TagWithoutContent
extends
	HTMLTags_Tag
{
	public function
		get_as_string()
	{
		$string = '';
		
		$string .= '<' . $this->get_name();
		
		if ($this->count_attributes() > 0) {
			$string .= $this->get_attribute_string();
		} else {
			$string .= ' ';
		}
		
		$string .= "/>\n";
		
		return $string;
	}
}
?>