<?php
/**
 * The main .INC for the create-new-www-page script.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

/*
 * Find the www includes directory.
 */ 

$admin_includes_directory = NULL;

if ($page_section == 'project-specific') {
    $md = $project_directory->get_project_specific_directory();
} else {
    if ($page_section == 'plug-ins') {
        $md = $project_directory->get_plug_in_module_directory($page_module);
    } else if ($page_section == 'haddock') {
        $md = $project_directory->get_core_module_directory($page_module);
    }
}

if ($md->has_www_includes_directory()) {
    #echo "WWW includes directory already exists!\n";
} else {
    $md->create_www_includes_directory();
}

$www_includes_directory = $md->get_www_includes_directory();

/*
 * Create the page directory.
 */

if ($www_includes_directory->has_page($page_name, $page_type)) {
    #echo "Page directory already exists!\n";
} else {
    $www_includes_directory->create_page_directory($page_name, $page_type);
}

/*
 * Create the .INC files
 */
$page_directory = $www_includes_directory->get_page_directory($page_name, $page_type);

$page_directory->create_inc_files($copyright_holder);
?>
