<?php
/**
 * PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript
 *
 * @copyright 2008-06-02, RFI
 */

class
	PublicHTML_RestrictAccessToDirectoryOnTheServerCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$directory = $this->get_directory();
		
		PublicHTML_ServerAccessControlHelper
			::restrict_access_to_directory($directory);
	}
	
	private function
		get_directory()
	{
		if ($this->has_arg('directory')) {
			$directory
				= $this->get_arg('directory');
		} else {
			$directory
				= CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the name of the directory:' . PHP_EOL,
						new FileSystem_ExistingDirectoryRelativeToProjectRootValidator()
					);
				#= trim(fgets(STDIN));
				 
			#echo "The directory: $directory" . PHP_EOL;
		}
		
		#$directory = PROJECT_ROOT . DIRECTORY_SEPARATOR . $directory;
		
		return $directory;
	}
}
?>