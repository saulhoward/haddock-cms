<?php
/**
 * CLIScripts_CLIScriptsHelper
 *
 * @copyright 2008-06-13, RFI
 */

class
	CLIScripts_CLIScriptsHelper
{
	public static function
		create_cli_script(
			$new_script_name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$classes_directory = $module_directory->get_classes_directory();
		
		$cli_scripts_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'cli-scripts';
		
		#echo '$cli_scripts_directory_name: ' . $cli_scripts_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($cli_scripts_directory_name);
		
		$script_class_name
			= $module_directory->get_camel_case_root()
				. '_' . $new_script_name . 'CLIScript';
		
		#echo '$script_class_name: ' . $script_class_name . PHP_EOL;
		
		$cli_script_file_name
			= $cli_scripts_directory_name
				. DIRECTORY_SEPARATOR
				. $script_class_name . '.inc.php';
		
		#echo '$cli_script_file_name: ' . $cli_script_file_name . PHP_EOL;
		
		if (is_file($cli_script_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$cli_script_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $module_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $script_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$script_class_name
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		/*
		 * Write code here.
		 */
	}
}
?>
CNT;

			if ($fh = fopen($cli_script_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				CLIScripts_ScriptObjectRunnersHelper
					::generate_script_object_runners();
			}
		}
	}
}
?>