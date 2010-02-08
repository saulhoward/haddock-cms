<?php
/**
 * HaddockProjectOrganisation_AssembleAutoloadFileCLIScript
 *
 * @copyright 2008-05-23, RFI
 */

class
	HaddockProjectOrganisation_AssembleAutoloadFileCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		HaddockProjectOrganisation_AutoloadFilesHelper
			::refresh_autoload_file();
	}
}
?>