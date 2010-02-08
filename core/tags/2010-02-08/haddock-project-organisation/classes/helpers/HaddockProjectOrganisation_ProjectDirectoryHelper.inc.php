<?php
/**
 * HaddockProjectOrganisation_ProjectDirectoryHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	HaddockProjectOrganisation_ProjectDirectoryHelper
{
	public static function
		get_project_directory()
	{
		$pdf
			= HaddockProjectOrganisation_ProjectDirectoryFinder
				::get_instance();
		
		return $pdf->get_project_directory_for_this_project();
	}
}
?>