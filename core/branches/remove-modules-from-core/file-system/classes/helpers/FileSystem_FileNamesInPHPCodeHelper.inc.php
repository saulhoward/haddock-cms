<?php
/**
 * FileSystem_FileNamesInPHPCodeHelper
 *
 * @copyright 2009-02-01, Robert Impey
 */

/*
 * A collection of functions for turning file names
 * into snippets of PHP code that are portable.
 *
 * For example, the string "foo\bar\bam.txt" for a file on a Windows machine
 * would not be useable in portable PHP code.
 *
 * The first use of this code was for writing the autoload function.
 */
class
	FileSystem_FileNamesInPHPCodeHelper
{
	/**
	 * Translates a file name to a snippet of code that could be used in
	 * portable PHP code.
	 * 
	 * @param string $file_name The file name (e.g. as returned by the OS)
	 * @return string The file name as a snippet of portable PHP code.
	 */
	public static function
		translate_file_name_to_php_code($file_name)
	{
		#echo "\$file_name: $file_name\n";
		
		$php_code_string = '';
		
		$directories = preg_split("{\\\\|/}", $file_name);
		
		#print_r($directories);
		
		for (
			$i = 0;
			$i < count($directories);
			$i++
		) {		
			if (strlen($directories[$i]) > 0) {
				if ($i > 0) {
					$php_code_string .= ' . ';
				}
				
				$php_code_string .= '\'' . $directories[$i] . '\'';
				
				#if ($i < (count($directories) - 1)) {
				#	$php_code_string .= ' . ';
				#}
				
				if (
					($i == 0)
					&&
					($i < (count($directories) - 1))
				) {
					$php_code_string .= ' . ';
				}
			}
			
			#if ($i > 0) {
			#	$php_code_string .= ' . ';
			#}
			
			if ($i < (count($directories) - 1)) {
				if ($i > 0) {
					$php_code_string .= ' . ';
				}
				
				$php_code_string .= 'DIRECTORY_SEPARATOR';
			}
		}
		
		#echo "\$php_code_string: $php_code_string\n";
		
		return $php_code_string;
	}
}
?>