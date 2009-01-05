<?php
class
	MailingList_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/mailing-list/';
	}
	
	public function
		get_sign_up_html_page_class_name()
	{
		return $this->get_config_value('page-classes/html-pages/sign-up');
	}
	
	public function
		get_sign_up_redirect_script_class_name()
	{
		return $this->get_config_value('page-classes/redirect-scripts/sign-up');
	}
}
?>