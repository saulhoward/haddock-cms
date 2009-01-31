<?php
/**
 * Database_ListDeltaFilesCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_ListDeltaFilesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_DeltaFilesHelper::list_delta_files();
	}
}
?>