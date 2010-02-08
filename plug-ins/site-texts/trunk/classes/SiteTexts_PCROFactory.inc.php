<?php
/**
 * SiteTexts_PCROFactory
 *
 * @copyright 2009-06-07, Robert Impey
 */

class
	SiteTexts_PCROFactory
extends
	PublicHTML_PCROFactory
{
	public function
		get_page_class_reflection_object_name()
	{
		$page_class_name = SiteTexts_PagesHelper::get_page_class_name();
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			echo '$page_class_name: ' . $page_class_name . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		return $page_class_name;
	}
}
?>
