<?php
/**
 * VideoLibrary_ExternalVideoLibrariesCRUDManager
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ExternalVideoLibrariesCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'VideoLibrary_ManageExternalVideoLibrariesAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'VideoLibrary_ManageExternalVideoLibrariesAdminRedirectScript';
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$id = $key_values['id'];
			
			return <<<SQL
SELECT
	*
FROM
	hpi_video_library_external_video_libraries
WHERE
	id = $id
SQL;

		}
	}
}
?>
