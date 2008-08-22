<?php
/**
 * PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript
 *
 * @copyright 2008-06-02, RFI
 */

class
	PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript
extends
	FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript
{
	public function
		do_actions()
	{
		PublicHTML_ServerAccessControlHelper
			::restrict_access_to_directory(
				$this->get_directory()
			);
	}
}
?>