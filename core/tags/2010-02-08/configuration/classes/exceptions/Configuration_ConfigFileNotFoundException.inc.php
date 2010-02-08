<?php
/**
 * Configuration_ConfigFileNotFoundException
 *
 * @copyright 2008-05-30, RFI
 */

abstract class
	Configuration_ConfigFileNotFoundException
extends
	ErrorHandling_SprintfException
{
	public function
		__construct(
			$config_file_name,
			$module_name,
			$type_of_config_file
		)
	{
		$error_message_format_string
			= '"%s" config file of type "%s" for the "%s" module not found!';
			
		parent
			::__construct(
				$error_message_format_string,
				array(
					$config_file_name,
					$type_of_config_file,
					$module_name
				)
			);
	}
}
?>