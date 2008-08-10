<?php
/**
 * Database_ListUnappliedDeltaFilesCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_ListUnappliedDeltaFilesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_DeltaFilesHelper::list_unapplied_delta_files();
	}
}
?>