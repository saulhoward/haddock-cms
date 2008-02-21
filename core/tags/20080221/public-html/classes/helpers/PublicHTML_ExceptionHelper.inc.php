<?php
class PublicHTML_ExceptionHelper
{
	public static function
		set_session_and_get_exception_page_url(Exception $e)
	{
		$_SESSION['exception'] = $e;
		
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		
		$phcm = $cmf->get_config_manager('haddock', 'public-html');
		
		$exception_page_class_name = $phcm->get_exception_page_class_name();
		
		$exception_page_url
			= PublicHTML_URLHelper
				::get_oo_page_url($exception_page_class_name);
		
		return $exception_page_url;
	}
}
?>