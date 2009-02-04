<?php
/**
 * HaddockProjectOrganisation_SetInitalTimeCLIScript
 *
 * @copyright 2009-02-04, Robert Impey
 */

class
	HaddockProjectOrganisation_SetInitalTimeCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		HaddockProjectOrganisation_InitialTimeHelper::set_initial_date();
	}
}
?>