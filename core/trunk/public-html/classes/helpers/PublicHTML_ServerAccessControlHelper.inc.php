<?php
/**
 * PublicHTML_ServerAccessControlHelper
 *
 * @copyright 2008-06-02, RFI
 */

class
	PublicHTML_ServerAccessControlHelper
{
	public static function
		restrict_access_to_directory($directory)
	{
		$validator
			= new FileSystem_ExistingDirectoryRelativeToProjectRootValidator();
		if ($validator->validate($directory)) {
			$abs_directory = PROJECT_ROOT . DIRECTORY_SEPARATOR . $directory;
			
			$htaccess_file_name = $abs_directory . DIRECTORY_SEPARATOR . '.htaccess';
			
			if (file_exists($htaccess_file_name)) {
				$back_up_htaccess_file_name = $htaccess_file_name . '_' . date('U');
				
				rename(
					$htaccess_file_name,
					$back_up_htaccess_file_name
				);
			}
			
			$copyright_holder
				= HaddockProjectOrganisation_ProjectInformationHelper
					::get_copyright_holder();
			
			$date = date('Y-m-d');
			
			if ($fh = fopen($htaccess_file_name, 'w')) {
				$htaccess_file_content = <<<HTA
# Restricting access to $directory
# (c) $date, $copyright_holder

Order Deny,Allow
Deny from all

HTA;

				fwrite($fh, $htaccess_file_content);
				
				fclose($fh);
			}
		}
	}
}
?>