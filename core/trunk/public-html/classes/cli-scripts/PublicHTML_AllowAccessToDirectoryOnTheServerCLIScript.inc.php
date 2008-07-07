<?php
/**
 * PublicHTML_AllowAccessToDirectoryOnTheServerCLIScript
 *
 * @copyright 2008-07-07, Robert Impey
 */

class
	PublicHTML_AllowAccessToDirectoryOnTheServerCLIScript
extends
	FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript
{
	public function
		do_actions()
	{
		PublicHTML_ServerAccessControlHelper
			::allow_access_to_directory(
				$this->get_directory()
			);
	}
}
?>