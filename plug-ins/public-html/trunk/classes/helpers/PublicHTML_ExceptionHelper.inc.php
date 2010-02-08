<?php
/**
 * PublicHTML_ExceptionHelper
 *
 * @copyright 2008-03-09, RFI
 */

class
	PublicHTML_ExceptionHelper
{
	public static function
		set_session_and_get_exception_page_url(
			Exception $e
		)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$_SESSION['exception'] = $e;
		
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$phcm = $cmf->get_config_manager('plug-ins', 'public-html');
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$exception_page_class_name = $phcm->get_exception_page_class_name();
		
		$exception_page_url
			= PublicHTML_URLHelper
				::get_oo_page_url($exception_page_class_name);
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		return $exception_page_url;
	}
}
?>