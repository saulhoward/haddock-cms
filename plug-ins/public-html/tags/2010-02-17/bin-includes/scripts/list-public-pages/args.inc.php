<?php
/**
 * The args for the list-public-pages script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

//if (isset($args['search-section'])) {
//    $search_section = $args['search-section'];
//} else {
//    echo "The section that will be searched must be set.\n";
//    
//    $search_section = CLIScripts_InputReader::get_choice_from_string('haddock plug-ins project-specific');
//    
//    if (!isset($search_section)) {
//        echo "Quitting!\n";
//        exit;
//    }
//}
//
//$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
//$project_directory = $pdf->get_project_directory_for_this_project();
//
//if ($search_section != 'project-specific') {
//    if (isset($args['search-module'])) {
//        $search_module = $args['search-module'];
//    } else {
//        if ($search_section == 'haddock') {
//            $module_directories = $project_directory->get_core_module_directories();
//        } else if ($search_section == 'plug-ins') {
//            $module_directories = $project_directory->get_plug_in_module_directories();
//        }
//        
//        $choice_str = '';
//        $first = TRUE;
//        foreach ($module_directories as $md) {
//            if ($first) {
//                $first = FALSE;
//            } else {
//                $choice_str .= ' ';
//            }
//            
//            $choice_str .= $md->get_identifying_name();
//        }
//        
//        echo "The module that will be searched must be set: \n";
//        
//        $search_module = CLIScripts_InputReader::get_choice_from_string($choice_str);
//        
//        if (!isset($search_module)) {
//            echo "Quitting!\n";
//            exit;
//        }
//    }
//} else {
//    if (isset($args['script-module'])) {
//        throw new Exception('No module should be set if the section is project-specific!');
//    }
//}

$section_and_module = HaddockProjectOrganisation_CLIModuleDirectoryFinder
    ::find_section_and_module(
        $args,
        'search-section',
        "The section to search must be set:\n",
        'search-module',
        "The module to search must be set:\n"
    );

$search_section = $section_and_module['section'];
$search_module = $section_and_module['module'];

if (isset($args['search-type'])) {
    $search_type = $args['search-type'];
} else {
    echo "Please enter the type of file that you are interested in.\n";
    echo "Leave blank to just list pages of all types.\n";
    
    $search_type = trim(fgets(STDIN));
}

if (!$silent) {
    echo "The search section: $search_section\n";
    echo "The class module: $search_module\n";
    echo "The type: $search_type\n";
}
?>
