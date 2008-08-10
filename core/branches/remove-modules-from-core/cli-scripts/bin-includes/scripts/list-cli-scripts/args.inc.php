<?php
/**
 * The args for the list-cli-scripts script.
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

echo "Do you want to list all the CLI scripts in the project?\n";
$all_project = CLIScripts_InputReader::ask_yes_no_question();

if (!$all_project) {
    $section_and_module
        = HaddockProjectOrganisation_CLIModuleDirectoryFinder
            ::find_section_and_module(
                $args,
                'search-section',
                "Search for scripts in which section?\n",
                'search-module',
                "Search for scripts in which module?\n"
            );
} else {
    $section_and_module = NULL;
}

echo "Do you want to refresh the wrapper scripts?\n";
$refresh_wrapper_scripts = CLIScripts_InputReader::ask_yes_no_question();

if (!$silent) {
    if ($all_project) {
        echo "Searching the entire project.\n";
    } else {
        echo "Searching individual modules.\n";
    }
    
    if (isset($section_and_module)) {
        print_r($section_and_module);
    }
    
    echo ($refresh_wrapper_scripts ? 'R' : 'Not r') . "efreshing the wrapper scripts.\n";
}
?>
