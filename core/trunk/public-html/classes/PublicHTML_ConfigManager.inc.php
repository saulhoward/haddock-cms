<?php
/**
 * PublicHTML_ConfigManager
 * 
 * @copyright 2007-10-16, RFI
 */

class
	PublicHTML_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/haddock/public-html/';
	}

	/**
	 * Makes the title for the error page.
	 * 
	 * This title can be set in the project-specific or instance-specific
	 * config file for this module.
	 * 
	 * If it is not set in the config file, the name of the project is
	 * fetched from the HPO config manager and a title is generated.
	 */	
	public function
		get_error_page_title()
	{
		$ept = '';

		$eptcvn = 'error-page/title';
		if ($this->has_config_value($eptcvn)) {
			$ept .= $this->get_config_value($eptcvn);
		} else {
			/*
			 * Find the name of the project, if it's been set.
			 */
			$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
			$hpo_cm = $cmf->get_config_manager('haddock', 'haddock-project-organisation');
#			if ($hpo_cm->has_nested_config_variable_str('project name')) {
#				$ept .= $hpo_cm->get_nested_config_variable_str('project name');
#			}
			$ept .= $hpo_cm->get_project_name();

			#$ept .= $this->get_nested_config_variable_str('page-elements titles separator');
			$ept .= $this->get_page_elements_titles_separator();
					
			#$ept .= $this->get_nested_config_variable_str('pages error title ending');
			$ept .= $this->get_page_elements_title_ending();
		}

		return $ept;
	}

	public function
		get_page_elements_titles_separator()
	{
		return $this->get_config_value('page-elements/titles/separator');
	}

	public function
		get_page_elements_title_ending()
	{
		return $this->get_config_value('pages/error/title/ending');
	}

	public function
		get_error_message_page_not_found()
	{
		return $this->get_config_value('error-messages/page-not-found');
	}
	
	public function
		get_exception_page_class_name()
	{
		return $this->get_config_value('oo-page-classes/exception');
	}
	
	public function
		are_exception_names_printed()
	{
		$value = $this->get_config_value('verbosity/exceptions/names-are-printed');
		
		#echo $value; exit;
		
		return $value == 'TRUE';
	}
	
	public function
		are_exception_trace_lists_printed()
	{
		$value = $this->get_config_value('verbosity/exceptions/stack-traces-are-printed');
		
		#echo $value; exit;
		
		return $value == 'TRUE';
	}
	
	public function
		get_default_url()
	{
		return $this->get_config_value('locations/default');
	}
	
	public function
		is_meta_page_about_haddock_cms_shown()
	{
		return $this->get_config_value('verbosity/meta-pages/show-about-haddock-cms') == 'TRUE';
	}
	
	public function
		server_has_mod_rewrite()
	{
		return $this->get_config_value('server_capabilities/has_mod_rewrite') == 'TRUE';
	}
}
?>
