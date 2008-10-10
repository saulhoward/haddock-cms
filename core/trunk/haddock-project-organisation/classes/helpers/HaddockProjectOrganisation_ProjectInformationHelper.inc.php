<?php
/**
 * HaddockProjectOrganisation_ProjectInformationHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	HaddockProjectOrganisation_ProjectInformationHelper
{
	private static function
		get_project_information_directory_name()
	{
		$project_specific_directory
			= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
				::get_project_specific_directory();
		
		return
			$project_specific_directory->get_name()
			. DIRECTORY_SEPARATOR
			. 'config'
			. DIRECTORY_SEPARATOR
			. 'haddock-project-organisation';
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the project name
	 * ----------------------------------------
	 */
	
	private static function
		get_name_file_name()
	{
		return
			self::get_project_information_directory_name()
			. DIRECTORY_SEPARATOR
			. 'name.txt';
	}
	
	public static function
		get_name()
	{
		#$config_file = self::get_project_specific_config_file();
		#return $config_file->get_project_name();
		
		$name_file_name = self::get_name_file_name();
		
		if (!is_file($name_file_name)) {
			throw new FileSystem_FileNotFoundException($name_file_name);
		}
		
		return trim(file_get_contents($name_file_name));
	}
	
	public static function
		set_name($name)
	{
		$validator = new HaddockProjectOrganisation_ProjectNameValidator();
		
		if ($validator->validate($name)) {
			$name_file_name = self::get_name_file_name();
			
			$project_information_directory_name
				= self::get_project_information_directory_name();
			
			if (!is_dir($project_information_directory_name)) {
				#mkdir($project_information_directory_name);
				FileSystem_DirectoryHelper
					::mkdir_parents($project_information_directory_name);
			}
			
			if ($fh = fopen($name_file_name, 'w')) {
				fwrite($fh, $name . PHP_EOL);
				
				fclose($fh);
			}
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the project title
	 * ----------------------------------------
	 */
	
	private static function
		get_title_file_name()
	{
		return
			self::get_project_information_directory_name()
			. DIRECTORY_SEPARATOR
			. 'title.txt';
	}
	
	public static function
		get_title()
	{
		#$config_file = self::get_project_specific_config_file();
		#return $config_file->get_project_title();

		$title_file_name = self::get_title_file_name();
		
		if (is_file($title_file_name)) {
			return trim(file_get_contents($title_file_name));
		} else {
			$name = self::get_name();
			
			$name_low
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string($name, '-');
			
			return $name_low->get_words_as_capitalised_string();
		}
	}
	
	public static function
		set_title($title)
	{
		$title_file_name = self::get_title_file_name();
		
		$project_information_directory_name = self::get_project_information_directory_name();
		
		if (!is_dir($project_information_directory_name)) {
			mkdir($project_information_directory_name);
		}
		
		if ($fh = fopen($title_file_name, 'w')) {
			fwrite($fh, $title . PHP_EOL);
			
			fclose($fh);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the project copyright holder
	 * ----------------------------------------
	 */
	
	#public static function
	#	get_copyright_holder()
	#{
	#	$config_file = self::get_project_specific_config_file();
	#	return $config_file->get_copyright_holder();
	#}
	
	private static function
		get_copyright_holder_file_name()
	{
		return
			self::get_project_information_directory_name()
			. DIRECTORY_SEPARATOR
			. 'copyright-holder.txt';
	}
	
	public static function
		get_copyright_holder()
	{
		#$config_file = self::get_project_specific_config_file();
		#return $config_file->get_project_title();

		$copyright_holder_file_name = self::get_copyright_holder_file_name();
		
		if (!is_file($copyright_holder_file_name)) {
			throw new FileSystem_FileNotFoundException($copyright_holder_file_name);
		}
		
		return trim(file_get_contents($copyright_holder_file_name));
	}
	
	public static function
		set_copyright_holder($copyright_holder)
	{
		$copyright_holder_file_name = self::get_copyright_holder_file_name();
		
		$project_information_directory_name = self::get_project_information_directory_name();
		
		if (!is_dir($project_information_directory_name)) {
			mkdir($project_information_directory_name);
		}
		
		if ($fh = fopen($copyright_holder_file_name, 'w')) {
			fwrite($fh, $copyright_holder . PHP_EOL);
			
			fclose($fh);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the project version code
	 * ----------------------------------------
	 */
	
	#public static function
	#	get_version_code()
	#{
	#	$config_file = self::get_project_specific_config_file();
	#	return $config_file->get_version_code();
	#}
	
	private static function
		get_version_code_file_name()
	{
		return
			self::get_project_information_directory_name()
			. DIRECTORY_SEPARATOR
			. 'version-code.txt';
	}
	
	public static function
		get_version_code()
	{
		#$config_file = self::get_project_specific_config_file();
		#return $config_file->get_project_title();

		$version_code_file_name = self::get_version_code_file_name();
		
		if (!is_file($version_code_file_name)) {
			throw new FileSystem_FileNotFoundException($version_code_file_name);
		}
		
		return trim(file_get_contents($version_code_file_name));
	}
	
	public static function
		set_version_code($version_code)
	{
		$version_code_file_name = self::get_version_code_file_name();
		
		$project_information_directory_name = self::get_project_information_directory_name();
		
		if (!is_dir($project_information_directory_name)) {
			mkdir($project_information_directory_name);
		}
		
		if ($fh = fopen($version_code_file_name, 'w')) {
			fwrite($fh, $version_code . PHP_EOL);
			
			fclose($fh);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the project camel case root.
	 * ----------------------------------------
	 */
	
	#public static function
	#	get_camel_case_root()
	#{
	#	$config_file = self::get_project_specific_config_file();
	#	return $config_file->get_camel_case_root();
	#}
	
	private static function
		get_camel_case_root_file_name()
	{
		return
			self::get_project_information_directory_name()
			. DIRECTORY_SEPARATOR
			. 'camel-case-root.txt';
	}
	
	public static function
		get_camel_case_root()
	{
		#$config_file = self::get_project_specific_config_file();
		#return $config_file->get_project_title();

		$camel_case_root_file_name = self::get_camel_case_root_file_name();
		
		if (is_file($camel_case_root_file_name)) {
			return trim(file_get_contents($camel_case_root_file_name));
		} else {
			$name = self::get_name();
			
			$name_low = Formatting_ListOfWordsHelper::get_list_of_words_for_string($name, '-');
			
			return $name_low->get_words_as_camel_case_string();
		}
	}
	
	public static function
		set_camel_case_root($camel_case_root)
	{
		$validator = new HaddockProjectOrganisation_CamelCaseRootValidator();
		
		if ($validator->validate($camel_case_root)) {
			$camel_case_root_file_name = self::get_camel_case_root_file_name();
			
			$project_information_directory_name
				= self::get_project_information_directory_name();
			
			if (!is_dir($project_information_directory_name)) {
				mkdir($project_information_directory_name);
			}
			
			if ($fh = fopen($camel_case_root_file_name, 'w')) {
				fwrite($fh, $camel_case_root . PHP_EOL);
				
				fclose($fh);
			}
		}
	}

	public static function
		get_start_page_widget_content()
	{
		$ul = new HTMLTags_UL();

		$info = array(
			'Title' => self::get_title(),
			'Version' => self::get_version_code(),
			'Copyright Holder' => self::get_copyright_holder()
		);

		$dl = new HTMLTags_DL();
		foreach ($info as $key => $value)
		{
			$dt = new HTMLTags_DT($key . ':&nbsp;');
			$dd = new HTMLTags_DD($value);

			$dl->append($dt);
			$dl->append($dd);
		}
		return $dl;
	}
}
?>
