<?php
/**
 * The main .INC for the list-cli-scripts script.
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$pd = $pdf->get_project_directory_for_this_project();

if ($all_project) {
    $script_directories = $pd->get_script_directories();
} else {
    if ($section_and_module['section'] == 'project-specific') {
        $module_directory = $pd->get_project_specific_directory();
    } else {
        if ($section_and_module['section'] == 'haddock') {
            $module_directory = $pd->get_core_module_directory($section_and_module['module']);
        } elseif ($section_and_module['section'] == 'plug-ins') {
            $module_directory = $pd->get_plug_in_module_directory($section_and_module['module']);
        }
    }
    
    $script_directories = $module_directory->get_script_directories();
}

/*
 * List the script directories.
 */
if (count($script_directories)) {
    echo "The script directories:\n";
    foreach ($script_directories as $sd) {
        echo 'Script name: ' . $sd->get_script_name() . "\n";
        
        echo 'Location: ' . $sd->get_name() . "\n";
        
        echo "\n";
        
        if ($refresh_wrapper_scripts) {
            $sd->refresh_wrapper_scripts();
        }
    }
} else {
    echo "No scripts found.\n";
}
?>
