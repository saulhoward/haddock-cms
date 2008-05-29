<?php
/**
 * ObjectOrientation_CompilationTests
 *
 * @copyright 2008-05-29, RFI
 */

class
	ObjectOrientation_CompilationTests
extends
	UnitTests_UnitTests
{
	public static function
		test_all_classes_compile_without_writing_to_stdout()
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		$php_class_files
			= $project_directory->get_php_class_files();
			
		$php_cli_interpreter
			= CLIScripts_InterpreterProgramHelper
				::get_php_cli_interpreter();
		
		$temp_dir = Environment_MachineHelper::get_temporary_directory();
		
		#print_r($temp_dir); exit;
		
		$tmp_out_file = $temp_dir->get_name() . '/haddock-compilations-tests-out.txt';
		$tmp_err_file = $temp_dir->get_name() . '/haddock-compilations-tests-err.txt';
		
		self::conditionally_unlink_tmp_files($tmp_out_file, $tmp_err_file);
		
		$define_debug_constants_file = PROJECT_ROOT
			. '/haddock/public-html/public-html/'
			. 'define-debug-constants.inc.php';
		
		$autoload_inc_file_name = PROJECT_ROOT
			. '/haddock/haddock-project-organisation/includes/'
			. 'autoload.inc.php';
			
		foreach (
			$php_class_files
			as
			$php_class_file
		) {
			$tmp_class_file_name = $temp_dir->get_name() . '/haddock-compilations-tests-tmp-' . $php_class_file->get_php_class_name() . '-class.php';
			
			$fh = fopen(
				$tmp_class_file_name,
				'w'
			);
			
			if ($fh) {
				fwrite($fh, '<?php define(\'PROJECT_ROOT\', \'' . PROJECT_ROOT . '\'); ?>');
				fwrite($fh, file_get_contents($define_debug_constants_file));
				fwrite($fh, file_get_contents($autoload_inc_file_name));
				fwrite($fh, file_get_contents($php_class_file->get_name()));
				
				fclose($fh);
				
				$cmd = "$php_cli_interpreter -f \"$tmp_class_file_name\" >> \"$tmp_out_file\" 2>> \"$tmp_err_file\"";
				
				#echo $cmd . PHP_EOL;
				
				system($cmd);
				
				unlink($tmp_class_file_name);
			}
		}
		
		$compile_and_out_file_files_string_length
			= strlen(file_get_contents($tmp_out_file)) + strlen(file_get_contents($tmp_err_file));
		
		self::conditionally_unlink_tmp_files($tmp_out_file, $tmp_err_file);
		
		return $compile_and_out_file_files_string_length == 0;
	}
	
	private static function
		conditionally_unlink_tmp_files(
			$tmp_out_file,
			$tmp_err_file
		)
	{
		if (file_exists($tmp_out_file)) {
			unlink($tmp_out_file);
		}
		if (file_exists($tmp_err_file)) {
			unlink($tmp_err_file);
		}
	}
}
?>