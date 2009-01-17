<?php
/**
 * The args for the script to list the classes in this project.
 *
 * @copyright Clear Line Web Design, 2007-07-04
 */


$batch_mode = isset($args['batch-mode']);

$whole_project = isset($args['whole-project']);

if (!$whole_project) {
    $section_and_module = HaddockProjectOrganisation_CLIModuleDirectoryFinder
        ::find_section_and_module(
            $args,
            'search-section',
            "The section to search must be set:\n",
            'search-module',
            "The module to search must be set:\n"
        );
}

if (isset($args['parent-class'])) {
    $parent_class = $args['parent-class'];
}

$output_in_csv = isset($args['csv']);
//$output_in_csv = FALSE;
//if ($batch_mode) {
//    $output_in_csv = isset($args['csv']);
//} else {
//    if (isset($args['csv'])) {
//        $output_in_csv = TRUE;
//    } else {
//        echo "Output in CSVs?\n";
//        $output_in_csv = CLIScripts_InputReader::get_choice_from_string('yes no');
//    }
//}

$methods = FALSE;
if ($batch_mode) {
    $methods = isset($args['methods']);
} else {
    if (isset($args['methods'])) {
        $methods = TRUE;
    } else {
        echo "Search for methods?\n";
        $methods = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
}

$files = FALSE;
if ($batch_mode) {
    $files = isset($args['files']);
} else {
    if (isset($args['files'])) {
        $files = TRUE;
    } else {
        echo "List the files?\n";
        $files = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
}

if ($methods) {
    $sort_methods = FALSE;
    if (isset($args['sort-methods'])) {
        $sort_methods = TRUE;
    } else {
        echo "Sort the methods?\n";
        $sort_methods = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
} else {
    if (isset($args['sort-methods'])) {
        throw new Exception('--sort-methods must not be set if --methods is not set!');
    }
}

if (!$silent) {
    echo $batch_mode ? "Running in batch mode.\n" : "Not running in batch mode.\n";
    
    if ($whole_project) {
        echo "Searching the whole project.\n";
    } else {
        echo 'Searching the ' . $section_and_module['section'] . " section.\n";
        
        if ($section_and_module['section'] != 'project-specific') {
            echo 'Searching the ' . $section_and_module['module'] . " module.\n";
        }
    }
    
    echo 'Output ' . ($output_in_csv ? '' : 'not ') . "in CSVs.\n";
    
    echo ($methods ? 'L' : 'Not l') . "isting the methods.\n";
    
    echo ($files ? 'L' : 'Not l') . "isting the files.\n";
}
?>
