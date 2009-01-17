<?php
/**
 * PublicHTML_ServerAccessControlHelper
 *
 * @copyright 2008-06-02, RFI
 */

/**
 * Helps with allowing and restricting access to directories
 * on the server.
 *
 * TO DO:
 * 	Refactor common elements of restrict_access_to_directory
 * 	and allow_access_to_directory to a private static function.
 */
class
	PublicHTML_ServerAccessControlHelper
{
	/**
	 * Restricts access to a directory on the server.
	 *
	 * Access to the directory is restricted using a .htaccess file.
	 *
	 * If there is already a .htaccess file in the directory, it is backed up first.
	 *
	 * @param string $directory The name of the directory, relative to PROJECT_ROOT.
	 */
	public static function
		restrict_access_to_directory($directory)
	{
		$validator
			= new FileSystem_ExistingDirectoryRelativeToProjectRootValidator();
			
		if ($validator->validate($directory)) {
			$abs_directory = PROJECT_ROOT . DIRECTORY_SEPARATOR . $directory;
			
			$htaccess_file_name = $abs_directory . DIRECTORY_SEPARATOR . '.htaccess';
			
			/*
			 * Back up the old file.
			 */
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
	
	/**
	 * Allows access to a directory on the server.
	 *
	 * Access to the directory is restricted using a .htaccess file.
	 *
	 * If there is already a .htaccess file in the directory, it is backed up first.
	 *
	 * @param string $directory The name of the directory, relative to PROJECT_ROOT.
	 */
	public static function
		allow_access_to_directory($directory)
	{
		$validator
			= new FileSystem_ExistingDirectoryRelativeToProjectRootValidator();
			
		if ($validator->validate($directory)) {
			$abs_directory = PROJECT_ROOT . DIRECTORY_SEPARATOR . $directory;
			
			$htaccess_file_name = $abs_directory . DIRECTORY_SEPARATOR . '.htaccess';
			
			/*
			 * Back up the old file.
			 */
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
# Allowing access to $directory
# (c) $date, $copyright_holder

Order Allow,Deny
Allow from all

HTA;

				fwrite($fh, $htaccess_file_content);
				
				fclose($fh);
			}
		}
	}
}
?>