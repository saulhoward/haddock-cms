<?php
/**
 * Interpret the args for the script to create new scripts.
 *
 * @copyright 2007-07-31, RFI
 */

/*
 * Create the singleton objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();

$cm = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

if (isset($args['script-section'])) {
	$script_section = $args['script-section'];
} else {
	echo "The section in which to save the script must be set.\n";

	$script_section
		= CLIScripts_InputReader
			::get_choice_from_string('haddock plug-ins project-specific');

	if (!isset($script_section)) {
		echo "Quitting!\n";
		exit;
	}
}

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory = $pdf->get_project_directory_for_this_project();

if ($script_section != 'project-specific') {
	if (isset($args['script-module'])) {
		$script_module = $args['script-module'];
	} else {
		if ($script_section == 'haddock') {
			$module_directories = $project_directory->get_core_module_directories();
		} else if ($script_section == 'plug-ins') {
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

		echo "The module in which to save the script must be set: \n";

		$script_module = CLIScripts_InputReader::get_choice_from_string($choice_str);

		if (!isset($script_module)) {
			echo "Quitting!\n";
			exit;
		}
	}
} else {
	if (isset($args['script-module'])) {
		throw new Exception('No module should be set in the section is project-specific!');
	}
}

if (isset($args['script-name'])) {
	$script_name = $args['script-name'];
} else {
	echo "Please enter a name for the script:\n";
	$script_name = trim(fgets(STDIN));
}

if (isset($args['copyright-holder'])) {
	$copyright_holder = $args['copyright-holder'];
} else {
	//if ($cm->has_config_file()) {
	//    $config_file = $project_directory->get_config_file();

		$copyright_holder = $cm->get_copyright_holder();
	//} else {
	//    echo "Please enter a name for the copyright holder:\n";
	//    $copyright_holder = trim(fgets(STDIN));
	//}
}

if (!$silent) {
	echo "The section in which to save the script: $script_section\n";
	echo "The module in which to save the script: $script_module\n";
	echo "The name of the script: $script_name\n";

	echo "The copyright holder: $copyright_holder\n";
}
?>