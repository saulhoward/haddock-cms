<?php

class
	DBPages_PCROFactory
extends
	PublicHTML_PCROFactory
{
	public function
		get_page_class_reflection_object_name()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = $cmf->get_config_manager('plug-ins', 'db-pages');
		
		return $config_manager->get_html_page_class_name();
	}
}

?>