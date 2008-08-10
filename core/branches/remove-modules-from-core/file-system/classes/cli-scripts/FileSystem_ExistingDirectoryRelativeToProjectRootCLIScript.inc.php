<?php
/**
 * FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript
 *
 * @copyright 2008-07-07, Robert Impey
 */

/**
 * Extend this CLI script class whenever you need a CLI
 * script that does something with an existing directory
 * that is relative to the project root.
 */
abstract class
	FileSystem_ExistingDirectoryRelativeToProjectRootCLIScript
extends
	CLIScripts_CLIScript
{
	/**
	 * Gets the name of the directory that the user wants to be
	 * the target of the script that implements this class.
	 *
	 * The directory can be set with a command line, if not
	 * then the user is asked.
	 *
	 * @return string The name of the directory.
	 */
	protected function
		get_directory()
	{
		$validator = new FileSystem_ExistingDirectoryRelativeToProjectRootValidator();
		
		if ($this->has_arg('directory')) {
			$directory
				= $this->get_arg('directory');
			
			try {
				$validator->validate($directory);
			} catch (InputValidation_InvalidInputException $e) {
				fwrite(
					STDERR,
					$e->getMessage() . PHP_EOL
				);
				exit;
			}
		} else {
			$directory
				= CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the name of the directory:' . PHP_EOL,
						$validator
					);
		}
		
		return $directory;
	}
}
?>