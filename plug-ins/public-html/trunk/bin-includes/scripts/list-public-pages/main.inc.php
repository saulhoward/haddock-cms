<?php
/**
 * The main .INC for the list-public-pages script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

$modules = array();

/*
 * Find the public-pages.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$pd = $pdf->get_project_directory_for_this_project();

if ($search_section == 'project-specific') {
    $module_directory = $project_directory->get_project_specific_directory();
} else {
    if ($search_section == 'haddock') {
        $module_directory = $project_directory->get_core_module_directory($search_module);
    } elseif ($search_section == 'plug-ins') {
        $module_directory = $project_directory->get_plug_in_module_directory($search_module);
    }
}

$public_includes_directory = $module_directory->get_public_includes_directory();

$pages_directory = $public_includes_directory->get_pages_directory();

$page_directories = $pages_directory->get_page_directories();

foreach ($page_directories as $page_directory) {
    if (strlen($search_type) > 0) {
        
    } else {
        echo 'page: ' . $page_directory->get_page_name() . "\n";
    }
}

/*
 * Require a user response before exiting.
 */
echo "Press \"ENTER\" to exit.\n";
$reply = trim(fgets(STDIN));
?>
