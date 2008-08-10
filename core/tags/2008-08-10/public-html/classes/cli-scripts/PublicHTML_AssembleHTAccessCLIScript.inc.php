<?php
/**
 * PublicHTML_AssembleHTAccessCLIScript
 *
 * @copyright 2008-05-23, RFI
 */

class
	PublicHTML_AssembleHTAccessCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		/*
		 * Backup the old file.
		 */
		echo "Backing up the old .htaccess file:\n\n";
		
		$htaccess_filename = PROJECT_ROOT . '/.htaccess';
		if (is_file($htaccess_filename)) {
			$seconds = date('U');
			
			$backup_filename = $htaccess_filename . '_' . $seconds;
			
			if (rename($htaccess_filename, $backup_filename)) {
				echo "$htaccess_filename renamed $backup_filename\n";
			} else {
				throw new Exception("Unable to rename $htaccess_filename as $backup_filename!");
			}
		} else {
			echo "No .htaccess file found!\n";
		}
		
		echo "\n";
		
		$htaccess_file_contents = '';
		
		$date = date('Y-m-d');
		/*
		 * Put a comment at the start of the file.
		 */
		$htaccess_file_contents .= "########################################################### \n";
		$htaccess_file_contents .= "## .htaccess file auto-generated on $date.\n";
		$htaccess_file_contents .= "## \n";
		$htaccess_file_contents .= "## DO NOT EDIT THIS FILE!\n";
		$htaccess_file_contents .= "## \n";
		$htaccess_file_contents .= "## Find and edit the various doc-root.htaccess files and \n";
		$htaccess_file_contents .= "## then run the assemble-htaccess script in the public-html\n";
		$htaccess_file_contents .= "## core module.\n";
		$htaccess_file_contents .= "########################################################### \n";
		$htaccess_file_contents .= "\n";
		
		/*
		 * Find the start core file.
		 */
		$start_core_filename = PROJECT_ROOT . '/haddock/start-of-doc-root.htaccess';
		
		echo "Looking for the start .ht fragment: \n$start_core_filename\n\n";
		
		if (is_file($start_core_filename)) {
			echo "$start_core_filename found\n";
		
			$htaccess_file_contents .= "## Start of start core file.\n";
			
			$htaccess_file_contents .= file_get_contents($start_core_filename);
			
			$htaccess_file_contents .= "## End of start core file.\n";
		} else {
			echo "$start_core_filename not file found!\n";
		}
		
		echo "\n";
		
		/*
		 * Find the project-specific file.
		 */
		$project_specific_filename = PROJECT_ROOT . '/project-specific/doc-root.htaccess';
		
		echo "Looking for the Project Specific file: \n$project_specific_filename\n\n";
		
		if (is_file($project_specific_filename)) {
			echo "$project_specific_filename found\n";
		
			$htaccess_file_contents .= "## Start of project-specific file.\n";
			
			$htaccess_file_contents .= file_get_contents($project_specific_filename);
			
			$htaccess_file_contents .= "## End of project-specific file.\n";
		} else {
			echo "$project_specific_filename not file found!\n";
		}
		
		echo "\n";
		
		/*
		 * Find the plug-in files.
		 */
		$plug_ins_directory_name = PROJECT_ROOT . '/plug-ins';
		
		echo "Searching the Plug-ins Directory: \n$plug_ins_directory_name\n\n";
		
		if (is_dir($plug_ins_directory_name)) {
			$plug_ins_directory = new FileSystem_Directory($plug_ins_directory_name);
			
			foreach ($plug_ins_directory->get_subdirectories() as $sd) {
				$plug_in_htaccess_filename = $sd->get_name() . '/doc-root.htaccess';
				
				if (is_file($plug_in_htaccess_filename)) {
					echo "Found .htaccess file fragment $plug_in_htaccess_filename.\n";
					
					$htaccess_file_contents .= '## Start of the ' . $sd->basename() . " plug-in module's file.\n";
					
					$htaccess_file_contents .= file_get_contents($plug_in_htaccess_filename);
					
					$htaccess_file_contents .= '## End of the ' . $sd->basename() . " plug-in module's file.\n";
				} else {
					echo "$plug_in_htaccess_filename not file found!\n";
				}
			}
		} else {
			echo "$plug_ins_directory_name not found!\n";
		}
		
		echo "\n";
		
		/*
		 * Find the core files.
		 */
		$core_directory_name = PROJECT_ROOT . '/haddock';
		
		echo "Searching the Core Directory: \n$core_directory_name\n\n";
		
		if (is_dir($core_directory_name)) {
			echo "$core_directory_name found\n";
		
			$core_directory = new FileSystem_Directory($core_directory_name);
			
			foreach ($core_directory->get_subdirectories() as $sd) {
				$core_htaccess_filename = $sd->get_name() . '/doc-root.htaccess';
				
				if (is_file($core_htaccess_filename)) {
					$htaccess_file_contents .= '## Start of the ' . $sd->basename() . " core module's file.\n";
					
					$htaccess_file_contents .= file_get_contents($core_htaccess_filename);
					
					$htaccess_file_contents .= '## End of the ' . $sd->basename() . " core module's file.\n";
				} else {
					echo "$core_htaccess_filename not file found!\n";
				}
			}
		} else {
			echo "No core directory found!\n";
		}
		
		echo "\n";
		
		/*
		 * Find the end core file.
		 */
		$end_core_filename = PROJECT_ROOT . '/haddock/end-of-doc-root.htaccess';
		
		echo "Looking for the end .ht fragment: \n$end_core_filename\n\n";
		
		if (is_file($end_core_filename)) {
			echo "$end_core_filename found\n";
		
			$htaccess_file_contents .= "## Start of end core file.\n";
			
			$htaccess_file_contents .= file_get_contents($end_core_filename);
			
			$htaccess_file_contents .= "## End of end core file.\n";
		} else {
			echo "$end_core_filename not file found!\n";
		}
		
		echo "\n";
		
		/*
		 * Write the file.
		 */
		
		echo "Writing the .htaccess file: \n\n$htaccess_filename\n";
		
		if ($fh = fopen($htaccess_filename, 'w')) {
			fwrite($fh, $htaccess_file_contents);
			
			fclose($fh);
		} else {
			throw new Exception("Unable to open $htaccess_filename for writing!");
		}
	}
}
?>