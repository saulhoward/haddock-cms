<?php
/**
 * Defines an __autoload function if one hasn't already been set.
 *
 * This function runs much more slowly than the function that might be
 * defined in the autoload.inc.php file in the project specific directory
 * but does not depend on any other files, so it can act as a back up
 * until the autoload file has been generated.
 *
 * If you are using this file, you should run the assemble autoload
 * file script in the Haddock project organisation core module.
 *
 * @copyright 2008-03-17, RFI
 */

if (function_exists('__autoload')) {
	/*
	 * Nothing to do.
	 *
	 * Should an exception be thrown?
	 */
	#echo "__autoload already exists!\n";
} else {
	#echo "Defining the default __autoload function.\n";
	
	function
		__autoload($class_name)
	{
		#echo "Trying to find $class_name\n";
		
		$wanted_file = $class_name . '.inc.php';
		
		$dir_queue[] = PROJECT_ROOT;
		
		while ($current_dir = array_shift($dir_queue)) {
			foreach (glob("$current_dir/*") as $file) {
				#echo "Current file: $file\n";
				
				$rp_file = realpath($file);
				
				#echo "Current rp_file: $rp_file\n";
				
				#if ($wanted_file == $file) {
				#if (strpos($rp_file, $wanted_file)) {
				if (preg_match("{(?:\\\\|/)$wanted_file$}", $rp_file)) {
					#echo "Found: $rp_file\n";
					
					require_once $rp_file;
					
					return TRUE;
				}
				
				if (is_dir($file)) {
					$dir_queue[] = $rp_file;
				}
			}
		}
	}
}
?>