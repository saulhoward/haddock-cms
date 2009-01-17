<?php
/**
 * Database_ApplyUnappliedDeltaFilesCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_ApplyUnappliedDeltaFilesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_DeltaFilesHelper::apply_unapplied_delta_files();
	}
}
?>