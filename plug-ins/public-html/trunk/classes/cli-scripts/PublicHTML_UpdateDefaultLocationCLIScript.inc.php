<?php
/**
 * PublicHTML_UpdateDefaultLocationCLIScript
 *
 * @copyright 2008-12-16, Robert Impey
 */

class
	PublicHTML_UpdateDefaultLocationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$default_location = $this->get_default_location();
		
		PublicHTML_DefaultLocationHelper
			::update_default_location($default_location);
	}
	
	private function
		get_default_location()
	{
		if ($this->has_arg('default-location')) {
			return $this->get_arg('default-location');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the default location:' . PHP_EOL,
						new PublicHTML_DefaultLocationValidator()
					);
		}
	}
}
?>
