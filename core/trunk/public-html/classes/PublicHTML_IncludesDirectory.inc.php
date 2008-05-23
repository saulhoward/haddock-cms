<?php
/**
 * PublicHTML_IncludesDirectory
 *
 * @copyright 2007-07-31, RFI
 */

#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_IncludesDirectory.inc.php';
	
class
	PublicHTML_IncludesDirectory
extends
	HaddockProjectOrganisation_IncludesDirectory
{
	public function
		get_pages_directory()
	{
		if ($this->has_pages_directory()) {
			return new PublicHTML_PagesDirectory(
				$this->get_pages_directory_name(),
				$this
			);
		} else {
			throw new Exception('No pages directory!');
		}
	}
}
?>
