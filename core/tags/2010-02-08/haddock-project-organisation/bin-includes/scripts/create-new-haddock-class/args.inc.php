<?php
/**
 * The args for the create-new-haddock-class script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

if (isset($args['class-section'])) {
    $class_section = $args['class-section'];
} else {
    echo "The section in which to save the class must be set.\n";

    $class_section = CLIScripts_InputReader::get_choice_from_string('haddock plug-ins project-specific');

    if (!isset($class_section)) {
        echo "Quitting!\n";
        exit;
    }
}

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory = $pdf->get_project_directory_for_this_project();

if ($class_section != 'project-specific') {
    if (isset($args['class-module'])) {
        $class_module = $args['class-module'];
    } else {
        if ($class_section == 'haddock') {
            $module_directories = $project_directory->get_core_module_directories();
        } else if ($class_section == 'plug-ins') {
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

        echo "The module in which to save the class must be set: \n";

        $class_module = CLIScripts_InputReader::get_choice_from_string($choice_str);

        if (!isset($class_module)) {
            echo "Quitting!\n";
            exit;
        }
    }
} else {
    if (isset($args['script-module'])) {
        throw new Exception('No module should be set if the section is project-specific!');
    }
}

if (isset($args['class-name'])) {
    $class_name = $args['class-name'];
} else {
    echo "Please enter a name for the class:\n";
    $class_name = trim(fgets(STDIN));
}

if (!$silent) {
    echo "The class section: $class_section\n";
    echo "The class module: $class_module\n";
    echo "The class name: $class_name\n";
}
?>
