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
		return SiteTexts_PagesHelper::get_page_class_name();
	}
}
?>
