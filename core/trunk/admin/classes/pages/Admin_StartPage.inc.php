<?php
/**
 * Admin_StartPage
 *
 * @copyright 2008-10-10, SANH
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
		/*
		 * Should retrieve an array of class names for widgets,
		 * So I'll / separate them and explode em
		 */
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('haddock', 'admin');
		$widget_classes= $config_manager->get_start_page_widget_classes();

		$div = new HTMLTags_Div();
		foreach ($widget_classes as $key => $value)
		{
			/* had to trim() this to make it work
			 */
			$content = call_user_func(array(trim($value), 'get_widget_div'));
			$div->append($content);
		}

		echo $div->get_as_string();
	}
}
?>
