<?php
/**
 * Admin_StartPage
 * Start Page Class
 *
 * Widgets are named in haddock/admin/config.xml
 * comma separated list
 *
 * @copyright 2008-10-10, SANH
 * @copyright 2009-10-08, Robert Impey
 */

class
	Admin_StartPage
extends
	Admin_RestrictedHTMLPage
{
	/*
	 * ----------------------------------------
	 * Functions to do with titles.
	 * ----------------------------------------
	 */
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Start';
	}

	public function
		content()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = $cmf->get_config_manager('plug-ins', 'admin');
		
		$widget_classes= $config_manager->get_start_page_widget_classes();

		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'StartPageWidgetContainer');
		foreach ($widget_classes as $key => $value)
		{
			$widget_class_str = trim($value);
			$instance = new $widget_class_str();
			$content = $instance->get_widget_div();
			$div->append($content);
		}

		echo $div->get_as_string();
	}
}
?>
