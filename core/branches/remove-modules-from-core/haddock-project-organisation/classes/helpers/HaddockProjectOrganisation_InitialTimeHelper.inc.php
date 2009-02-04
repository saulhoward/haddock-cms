<?php
/**
 * HaddockProjectOrganisation_InitialTimeHelper
 *
 * @copyright 2009-02-04, Robert Impey
 */

class
	HaddockProjectOrganisation_InitialTimeHelper
{
	public static function
		set_initial_date()
	{
		$initial_date_file_name = self::get_initial_date_file_name();
		
		if (
			$fh = fopen($initial_date_file_name, 'w')
		) {
			fwrite(
				$fh,
				date('c') . PHP_EOL
			);
			
			fclose($fh);
		} else {
			throw new Exception('Unable to open initial date file!');
		}
	}
	
	public static function
		has_initial_date()
	{
		$initial_date_file_name = self::get_initial_date_file_name();
		
		return is_file($initial_date_file_name);
	}
	
	/**
	 * @param string $date_format The format of the 
	 * @return string The date that this project was started.
	 */
	public static function
		get_initial_date($date_format)
	{
		if (self::has_initial_date()) {
			return date(
				$date_format,
				strtotime(
					file_get_contents(
						self::get_initial_date_file_name()
					)
				)
			);
		} else {
			throw new Exception('No initial date for this project!');
		}
	}
	
	private static function
		get_initial_date_file_name()
	{
		$project_information_directory_name = HaddockProjectOrganisation_ProjectInformationHelper
			::get_project_information_directory_name(
				$create_directory_if_not_exists = TRUE
			);
		
		return $project_information_directory_name . DIRECTORY_SEPARATOR . 'initial-date.txt';
	}
}
?>