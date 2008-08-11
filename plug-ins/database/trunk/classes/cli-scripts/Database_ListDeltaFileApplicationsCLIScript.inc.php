<?php
/**
 * Database_ListDeltaFileApplicationsCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_ListDeltaFileApplicationsCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_DeltaFilesHelper::list_delta_file_applications();
	}
}
?>