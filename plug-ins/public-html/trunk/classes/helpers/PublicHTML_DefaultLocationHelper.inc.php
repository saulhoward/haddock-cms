<?php
/**
 * PublicHTML_DefaultLocationHelper
 *
 * @copyright 2008-12-16, Robert Impey
 */

class
	PublicHTML_DefaultLocationHelper
{
	private static function
		get_default_location_directory_name(
            $create_directory_if_not_exists = FALSE
        )
	{
		$project_specific_directory
			= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
				::get_project_specific_directory();
		
		$default_location_directory_name =
			$project_specific_directory->get_name()
			. DIRECTORY_SEPARATOR
			. 'config'
			. DIRECTORY_SEPARATOR
			. 'public-html';

            if ($create_directory_if_not_exists) {
                if (!is_dir($default_location_directory_name)) {
                    FileSystem_DirectoryHelper
                        ::mkdir_parents($default_location_directory_name);
                }
            }

            return $default_location_directory_name;
	}
	
	private static function
		get_default_location_file_name()
	{
		return
			self::get_default_location_directory_name()
			. DIRECTORY_SEPARATOR
			. 'default-location.txt';
	}

    /**
     * Gets the default location.
     *
     * @return string The default location.
     */
	public static function
		get_default_location()
	{
		$default_location_file_name = self::get_default_location_file_name();
		
		if (!is_file($default_location_file_name)) {
			throw new FileSystem_FileNotFoundException($default_location_file_name);
		}
		
		return trim(file_get_contents($default_location_file_name));
	}
	
	public static function
		set_default_location($default_location)
	{
		$validator = new PublicHTML_DefaultLocationValidator();
		
		if ($validator->validate($default_location)) {
			$default_location_file_name = self::get_default_location_file_name();
			
			$default_location_directory_name
				= self::get_default_location_directory_name(
                    $create_directory_if_not_exists = TRUE
                );
			
			if ($fh = fopen($default_location_file_name, 'w')) {
				fwrite($fh, $default_location . PHP_EOL);
				
				fclose($fh);
			}
		}
	}
	
	public static function
		update_default_location($default_location)
	{

		$validator = new PublicHTML_DefaultLocationValidator();
		
		if ($validator->validate($default_location)) {
			self::delete_default_location();
			
			$default_location_file_name = self::get_default_location_file_name();
			
			$default_location_directory_name
				= self::get_default_location_directory_name(
                    $create_directory_if_not_exists = TRUE
                );
			
			if ($fh = fopen($default_location_file_name, 'w')) {
				fwrite($fh, $default_location . PHP_EOL);
				
				fclose($fh);
			}
		}
	}
	
	public static function
		delete_default_location()
	{
		$default_location_file_name = self::get_default_location_file_name();
		
		if (is_file($default_location_file_name)) {
			unlink($default_location_file_name);
		}
	}
}
?>
