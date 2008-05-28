<?php
/**
 * HaddockProjectOrganisation_ShowProjectInformationCLIScript
 *
 * @copyright 2008-05-27, RFI
 */

class
	HaddockProjectOrganisation_ShowProjectInformationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$config_manager = Configuration_ConfigManagerHelper::get_config_manager('haddock', 'haddock-project-organisation');
		
		/*
		 * List the info.
		 */
		echo 'Information about your installation:' . PHP_EOL;
		
		printf(
			'Release major version: \'%s\'' . PHP_EOL,
			$config_manager->get_major_release_version()
		);
	}
}
?>