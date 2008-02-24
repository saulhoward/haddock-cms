<?php
class
	MailingList_PCROFactory
extends
	PublicHTML_PCROFactory
{
	public function
		get_page_class_reflection_object_name()
	{
		if (isset($_GET['page'])) {
			if (isset($_GET['type'])) {
				return
					$this->
						get_page_class_reflection_object_name_for_page(
							$_GET['page'],
							$_GET['type']
						);
			} else {
				throw new Exception("The type should be set in the get variable!");
			}
		} else {
			throw new Exception("The page should be set in the get variable!");
		}
	}
	
	public function
		get_page_class_reflection_object_name_for_page(
			$page_name,
			$type
		)
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = $cmf->get_config_manager('plug-ins', 'mailing-list');
		
		switch ($page_name) {
			case 'sign-up':
				switch ($type) {
					case 'html':
						return $config_manager->get_sign_up_html_page_class_name();
					case 'redirect-script':
						return $config_manager->get_sign_up_redirect_script_class_name();
				}
		}
		
		throw new Exception('Unknown page / type combination!');
	}
}

?>