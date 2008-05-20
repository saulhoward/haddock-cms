#!/usr/bin/php
<?php
/**
 * The program that runs all our command line
 * scripts.
 *
 * @copyright 2007-02-02, RFI
 */

/*
 * Work out the include directory contstants
 * from the file name.
 */
$dir_sep_rx = '(?:/|\\\\)';
#echo realpath($_SERVER['SCRIPT_FILENAME']) . "\n";

if (
	//preg_match(
	//    '{(.+haddock-projects(?:/|\\\\)[a-z-]+(?:/|\\\\)[a-z-]+(?:/|\\\\)[a-z-]+)}',
	//    realpath($_SERVER['SCRIPT_FILENAME']),
	//    $matches)
	preg_match(
		#'{(.+haddock-projects(?:/|\\\\)[a-z-]+(?:/|\\\\)[a-z-]+(?:/|\\\\)[a-z-]+)}',
		'{^(.+)' . $dir_sep_rx . 'haddock' . $dir_sep_rx . 'cli-scripts' . $dir_sep_rx . 'bin' . $dir_sep_rx . 'bin-runner.php}',
		realpath($_SERVER['SCRIPT_FILENAME']),
		$matches)
) {
	#print_r($matches);
	
	#define('PROJECT_ROOT', $matches[1] . '/public_html');
	define('PROJECT_ROOT', $matches[1]);
} else {
	die("Unable to define include paths!\n");
}

/*
 * Define the debug constants.
 */
require_once PROJECT_ROOT
	. '/haddock/public-html/public-html/define-debug-constants.inc.php';

//require_once PROJECT_ROOT
//    . '/haddock/cli-scripts/classes/CLIScripts_InputReader.inc.php';
//
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

#$autoload_filename = PROJECT_ROOT
#	. '/project-specific/haddock-project-organisation/'
#	. 'autoload.inc.php';
#	
#if (file_exists($autoload_filename)) {
#	require $autoload_filename;
#} else {
#	/*
#	 * Use the slow, default autoload function
#	 */
#	require PROJECT_ROOT
#		. '/haddock/haddock-project-organisation/includes/'
#		. 'autoload.inc.php';
#}

require PROJECT_ROOT
	. '/haddock/haddock-project-organisation/includes/'
	. 'autoload.inc.php';

#print_r($_SERVER);

/*
 * Get the command line args.
 */
#$args = array();
##$help = FALSE;
#for ($i = 0; $i < count($_SERVER['argv']); $i++) {
#	#echo '$_SERVER[\'argv\'][$i]' . "\n";
#	#echo $_SERVER['argv'][$i] . "\n";
#	
#	if (
#		preg_match(
#			'/^--([\w-]+)(?:=(.+))?$/',
#			$_SERVER['argv'][$i],
#			$matches
#		)
#	) {
#		#print_r($matches);
#		
#		#$args[$matches[1]] = $_SERVER['argv'][$i + 1];
#		if (isset($matches[2])) {
#			$args[$matches[1]] = $matches[2];
#		} else {
#			$args[$matches[1]] = TRUE;
#		}
##    } else {
##		echo "No match!\n";
#	}
#	
#	#if ($_SERVER['argv'][$i] == '--help') {
#	#    $help = TRUE;
#	#}
#}

$args
	= CLIScripts_ArgsHelper
		::parse_argv($_SERVER['argv']);

#echo "The args: \n";
#print_r($args);
#exit;

if (isset($args['oo-script'])) {
	try {
		if (isset($args['script-class'])) {
			#$cli_script_super_class_reflection_class
			#	= new ReflectionClass('CLIScripts_CLIScript');
			
			$script_class_reflection_class = new ReflectionClass($args['script-class']);
			
			if (
				$script_class_reflection_class->isSubclassOf('CLIScripts_CLIScript')
			) {
				$script_class_reflection_object
					= $script_class_reflection_class
						->newInstanceArgs(
							array(
								$args
							)
						);
				
				$script_class_reflection_object->main();
			} else {
				throw new Exception('The script-class must be a subclass of CLIScripts_CLIScript!');
			}
		} else {
			throw new Exception('The script-class must be set for an OO script!');
		}
	} catch (Exception $e) {
		CLIScripts_ExceptionsHelper
			::render_exception_trace($e);
	}
} else {
	if (isset($args['section'])) {
		$section = $args['section'];
	} else {
		echo "The section must be set:\n";
		
		$section
			= CLIScripts_InputReader
				::get_choice_from_string('haddock plug-ins project-specific');
		
		if (!isset($section)) {
			echo "Quitting!\n";
			exit;
		}
	}
	
	//echo "The section: $section\n";
	//exit;
	
	$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
	$project_directory = $pdf->get_project_directory_for_this_project();
	
	if ($section != 'project-specific') {
		if (isset($args['module'])) {
			$module = $args['module'];
		} else {
			if ($section == 'haddock') {
				$module_directories = $project_directory->get_core_module_directories();
			} else if ($section == 'plug-ins') {
				$module_directories = $project_directory->get_plug_in_module_directories();
			}
			
			$choice_str = '';
			$first = TRUE;
			foreach ($module_directories as $md) {
				if ($first) {
					$first = FALSE;
				} else {
					$choice_str .= ' ';
				}
				
				$choice_str .= $md->get_identifying_name();
			}
			
			echo "The module must be set: \n";
			
			$module = CLIScripts_InputReader::get_choice_from_string($choice_str);
			
			if (!isset($module)) {
				echo "Quitting!\n";
				exit;
			}
		}
	}
	
	//echo "The module: $module\n";
	//exit;
	
	if (isset($args['script'])) {
		$script = $args['script'];
	} else {
		if ($section == 'project-specific') {
			$module_directory = $project_directory->get_project_specific_directory();
		} else {
			if ($section == 'haddock') {
				$module_directories = $project_directory->get_core_module_directories();
			} else if ($section == 'plug-ins') {
				$module_directories = $project_directory->get_plug_in_module_directories();
			}
			
			foreach ($module_directories as $md) {
				if ($md->get_identifying_name() == $module) {
					$module_directory = $md;
					break;
				}
			}
		}
		
		$cli_script_directories = $module_directory->get_cli_script_directories();
		
		if (count($cli_script_directories) < 1) {
			die("No scripts found!\n");
		}
		
		$choice_str = '';
		
		$first = TRUE;
		foreach ($cli_script_directories as $csd) {
			 if ($first) {
				$first = FALSE;
			} else {
				$choice_str .= ' ';
			}
			
			$choice_str .= $csd->get_script_name();
		}
		
		echo "The script must be set: \n";
		
		$script = CLIScripts_InputReader::get_choice_from_string($choice_str);
		
		if (!isset($script)) {
			echo "Quitting!\n";
			exit;
		}
	}
	
	//echo "The script: $script\n";
	//exit;
	
	$inc_directory = PROJECT_ROOT . "/$section";
	
	//if ($args['module'] == 'project-specific') {
	//    $inc_directory .= '/project-specific';
	//} else {
	//    $inc_directory .= '/haddock/' . $args['module'];
	//    # TO DO: Plug in modules.
	//}
	
	if ($section != 'project-specific') {
		$inc_directory .= "/$module";
	}
	
	#$inc_directory .= '/bin-includes/scripts/' . $args['script'];
	$inc_directory .= '/bin-includes/scripts/' . $script;
	
	#echo "$inc_directory\n";
	
	/*
	 * Has the user asked for an existing script?
	 */
	if (!is_dir($inc_directory)) {
		$msg = "There is no script called $script ";
		
		if (isset($module)) {
			$msg .= "in the $module module ";
		}
		
		$msg .= "in the $section section!\n";
		
		die($msg);
	}
	
	/*
	 * Has the user asked for help?
	 */
	if (isset($args['help']) and $args['help']) {
		require $inc_directory . '/help.inc.php';
		exit;
	}
	
	/*
	 * Is this script running in silent mode?
	 * e.g. for the crontab
	 */
	if (isset($args['silent'])) {
		$silent = $args['silent'];
	} else {
		$silent = FALSE;
	}
	
	/*
	 * Are there any required args?
	 */
	if (file_exists($inc_directory . '/args.inc.php')) {
		require $inc_directory . '/args.inc.php';
	}
	
	/*
	 * Run the script.
	 */
	$script_inc_file_name
		= $inc_directory . '/main.inc.php';
	
	#echo "\$script_inc_file_name: $script_inc_file_name\n";
	
	if (file_exists($script_inc_file_name)) {
		try {
			require $script_inc_file_name;
		} catch (Exception $e) {
			CLIScripts_ExceptionsHelper
				::render_exception_trace($e);
		}
	} else {
		die(
			'There is no main .INC file for '
			. $args['script']
			. ' in '
			. $args['module']
			. "!\n"
		);
	}
}
?>