<?php
/**
 * PublicHTML_ExceptionRenderer
 *
 * @copyright Clear Line Web Design, 2008-02-05
 */

class
	PublicHTML_ExceptionRenderer
{
	/**
	 * Looks for an exception saved in a session and prints
	 * it off if it is found.
	 *
	 * If the config files for this project have been set
	 * up to print the stack trace of an exception, that is printed
	 * as well.
	 */
	public static function
		render_exception_div_from_session()
	{
		if (isset($_SESSION['exception'])) {
			$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
			
			$phcm = $cmf->get_config_manager('haddock', 'public-html');
			
			$exception_div
				= new HTMLTags_ExceptionDiv(
					$_SESSION['exception'],
					$phcm->are_exception_trace_lists_printed()
				);
			
			echo $exception_div->get_as_string();
		} else {
			echo "<p class=\"error\">No exception set!</p>\n";
		}
	}
}
?>