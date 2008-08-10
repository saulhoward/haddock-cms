<?php
/**
 * The main .INC file for the script that creates new haddock scripts.
 *
 * @copyright 2007-07-31, RFI
 */

/*
 * Create the project directory that we are working on.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory = $pdf->get_project_directory_for_this_project();

$module_directory = NULL;
if ($script_section == 'project-specific') {
	$module_directory = $project_directory->get_project_specific_directory();
} else {
	if ($script_section == 'haddock') {
		$module_directory
			= $project_directory->get_core_module_directory($script_module);
	} elseif ($script_section == 'plug-ins') {
		$module_directory
			= $project_directory->get_plug_in_module_directory($script_module);
	}
}

/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *
 *  TO DO:
 *
 *  Move this code into the script directory class.
 * 
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

$bin_includes_directory = PROJECT_ROOT . "/$script_section";

if ($script_section != 'project-specific') {
	$bin_includes_directory .= "/$script_module";
}

$bin_includes_directory .= "/bin-includes";

if (is_dir($bin_includes_directory)) {
	if (!$silent) {
		echo "\"$bin_includes_directory\" already exists!\n";
	}    
} else {
	if (!$silent) {
		echo "Creating \"$bin_includes_directory\".\n";
	}
	
	mkdir($bin_includes_directory);
}

$scripts_directory = $bin_includes_directory . '/scripts';

if (is_dir($scripts_directory)) {
	if (!$silent) {
		echo "\"$scripts_directory\" already exists!\n";
	}    
} else {
	if (!$silent) {
		echo "Creating \"$scripts_directory\".\n";
	}
	
	mkdir($scripts_directory);
}

$script_directory_name = $scripts_directory . "/$script_name";

if (is_dir($script_directory_name)) {
	if (!$silent) {
		echo "\"$script_directory_name\" already exists!\n";
	}    
} else {
	if (!$silent) {
		echo "Creating \"$script_directory_name\".\n";
	}
	
	mkdir($script_directory_name);
}

/*
 * Create a script directory object for the newly created script directory.
 */
$script_directory = $module_directory->get_script_directory($script_name);

/*
 * TO DO:
 *
 *  Move this code to the class.
 */

/*
 * Create the help file.
 */
$help_filename = $script_directory_name . '/help.inc.php';

if (file_exists($help_filename)) {
	if (!$silent) {
		echo "\"$help_filename\" already exists!\n";
	}
} else {
	if (!$silent) {
		echo "Creating \"$help_filename\".\n";
	}
	
	if ($fh = fopen($help_filename, 'w')) {
		$date = date('Y-m-d');
		
		fwrite($fh, "The $script_name script.\n");
		fwrite($fh, "© $date, $copyright_holder\n");
		
		fclose($fh);
	} else {
		throw new Exception("Unable to open $help_filename for writing!\n");
	}
}

/*
 * Create the args file.
 */
$args_filename = $script_directory_name . '/args.inc.php';

if (file_exists($args_filename)) {
	if (!$silent) {
		echo "\"$args_filename\" already exists!\n";
	}
} else {
	if (!$silent) {
		echo "Creating \"$args_filename\".\n";
	}
	
	if ($fh = fopen($args_filename, 'w')) {
		$date = date('Y-m-d');
		
		fwrite($fh, "<?php\n");
		fwrite($fh, "/**\n");
		fwrite($fh, " * The args for the $script_name script.\n");
		fwrite($fh, " *\n");
		fwrite($fh, " * @copyright $date, $copyright_holder\n");
		fwrite($fh, " */\n");
		fwrite($fh, "?>");
		
		fclose($fh);
	} else {
		throw new Exception("Unable to open $args_filename for writing!\n");
	}
}

/*
 * Create the main file.
 */
$main_filename = $script_directory_name . '/main.inc.php';

if (file_exists($main_filename)) {
	if (!$silent) {
		echo "\"$main_filename\" already exists!\n";
	}
} else {
	if (!$silent) {
		echo "Creating \"$main_filename\".\n";
	}
	
	if ($fh = fopen($main_filename, 'w')) {
		$date = date('Y-m-d');
		
		fwrite($fh, "<?php\n");
		fwrite($fh, "/**\n");
		fwrite($fh, " * The main .INC for the $script_name script.\n");
		fwrite($fh, " *\n");
		fwrite($fh, " * @copyright $date, $copyright_holder\n");
		fwrite($fh, " */\n");
		fwrite($fh, "?>");
		
		fclose($fh);
	} else {
		throw new Exception("Unable to open $main_filename for writing!\n");
	}
}

/*
 * Make sure that there's a bin directory for wrapper/short cuts.
 */
$bin_directory = PROJECT_ROOT . "/$script_section";

if ($script_section != 'project-specific') {
	$bin_directory .= "/$script_module";
}

$bin_directory .= "/bin";

if (is_dir($bin_directory)) {
	if (!$silent) {
		echo "\"$bin_directory\" already exists!\n";
	}    
} else {
	if (!$silent) {
		echo "Creating \"$bin_directory\".\n";
	}
	
	mkdir($bin_directory);
}

/*
 * Create the wrapper scripts file.
 */
$script_directory->create_wrapper_scripts();
?>