<?php
/**
 * HaddockProjectOrganisation_NavigationLinksFile
 *
 * @copyright 2007-01-24, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_TextFileWithComments.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_IncludesDirectory.inc.php';

/**
 * Represents a file called:
 *
 * /<MODULE>/(public|admin)-includes/pages/navigation-links.txt
 *
 * Comments in these files are lines starting '#'.
 *
 * Pages that you want to link to should be folders in
 *
 * /<MODULE>/(public|admin)-includes/pages/
 *
 * and should be lower case, hyphen separated words.
 *
 * The title of the link will be worked out algorithmically
 * from the folder name.
 *
 * e.g.
 *
 * password-generating
 *
 * ->
 *
 * Password Generating
 *
 * Titles can be overriden by adding a file called:
 *
 * /<MODULE>/(public-admin)-includes/pages/<PAGE>/page-config.txt
 *
 * that has a line somewhere in the file that is something like:
 *
 * page-title="Autoload .INC File Creation"
 */
abstract class
	HaddockProjectOrganisation_NavigationLinksFile
extends
	FileSystem_TextFileWithComments
{
	/**
	 * The includes directory that this file
	 * is saved in.
	 */
	private $includes_directory;
	
	public function
		__construct(
			$name,
			HaddockProjectOrganisation_IncludesDirectory $includes_directory
		)
	{
		parent::__construct($name);
		
		$this->includes_directory = $includes_directory;
	}
	
	public function
		get_includes_directory()
	{
		return $this->includes_directory;
	}
	
	abstract public function
		get_navigation_links();
}
?>