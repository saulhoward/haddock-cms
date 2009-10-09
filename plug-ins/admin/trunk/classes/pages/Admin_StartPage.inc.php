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
		
		/*
		 * The admin module has been moved to the plug-ins directory.
		 *
		 * RFI 2009-10-08
		 */
		#$config_manager = $cmf->get_config_manager('haddock', 'admin');
		$config_manager = $cmf->get_config_manager('plug-ins', 'admin');
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__FILE__: ' . __FILE__ . PHP_EOL;
			echo '__METHOD__: ' . __METHOD__ . PHP_EOL;
			echo '__LINE__: ' . __LINE__ . PHP_EOL;
			
			echo 'print_r($config_manager):' . PHP_EOL;
			print_r($config_manager);
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$widget_classes= $config_manager->get_start_page_widget_classes();

		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'StartPageWidgetContainer');
		foreach ($widget_classes as $key => $value)
		{
			/* had to trim() $value to make it work
			 */
			// $content = call_user_func(array(trim($value), 'get_widget_div'));

			/* Can't believe this works...
			 */
			$widget_class_str = trim($value);
			$instance = new $widget_class_str();
			$content = $instance->get_widget_div();
			$div->append($content);
		}

		echo $div->get_as_string();
	}
}
?>
