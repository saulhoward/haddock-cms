<?php
/**
 * FileSystem_FileNamesInPHPCodeHelperTests
 *
 * @copyright 2009-02-01, Robert Impey
 */

/**
 * Tests the code in FileSystem_FileNamesInPHPCodeHelper.
 */
class
	FileSystem_FileNamesInPHPCodeHelperTests
extends
	UnitTests_UnitTests
{
	public static function
		set_up()
	{
		/*
		 * Prepare the environment for each test in this class.
		 */
	}
	
	public static function
		tear_down()
	{
		/*
		 * Return the environment to a pristine state after
		 * each test in this class.
		 */
	}
	
	/*
	 * ----------------------------------------
	 * The tests.
	 * ----------------------------------------
	 */
	
	public static function
		test_all_unix_directory_separators_are_recognised()
	{
		$test_file_name = '/foo/bar/bam.txt';
		
		$desired_output = 'DIRECTORY_SEPARATOR . \'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_all_windows_directory_separators_are_recognised()
	{
		$test_file_name = '\foo\bar\bam.txt';
		
		$desired_output = 'DIRECTORY_SEPARATOR . \'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_mixed_unix_and_windows_directory_separators_are_recognised()
	{
		$test_file_name = '/foo\bar/bam.txt';
		
		$desired_output = 'DIRECTORY_SEPARATOR . \'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_file_names_without_directories_are_put_in_quotes()
	{
		$test_file_name = 'bam.txt';
		
		$desired_output = '\'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_relativate_all_unix_file_names()
	{
		$test_file_name = 'foo/bar/bam.txt';
		
		$desired_output = '\'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_relativate_all_windows_file_names()
	{
		$test_file_name = 'foo\bar\bam.txt';
		
		$desired_output = '\'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_relativate_mixed_unix_and_windows_file_names()
	{
		$test_file_name = 'foo\bar/bam.txt';
		
		$desired_output = '\'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam.txt\'';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
	
	public static function
		test_all_unix_directory_name_with_trailing_slash()
	{
		$test_file_name = 'foo/bar/bam/';
		
		$desired_output = '\'foo\' . DIRECTORY_SEPARATOR . \'bar\' . DIRECTORY_SEPARATOR . \'bam\' . DIRECTORY_SEPARATOR';
		#echo "\$desired_output: $desired_output\n";
		
		$output = FileSystem_FileNamesInPHPCodeHelper::translate_file_name_to_php_code($test_file_name);
		
		return $output == $desired_output;
	}
}
?>