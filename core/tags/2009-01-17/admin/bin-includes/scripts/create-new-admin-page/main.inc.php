<?php
/**
 * The main .INC for the create-new-admin-page script.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

/*
 * Find the admin includes directory.
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

if ($md->has_admin_includes_directory()) {
    #echo "Admin includes directory already exists!\n";
} else {
    $md->create_admin_includes_directory();
}

$admin_includes_directory = $md->get_admin_includes_directory();

/*
 * Create the admin page directory.
 */

if ($admin_includes_directory->has_page_directory($page_name)) {
    #echo "Page directory already exists!\n";
} else {
    $admin_includes_directory->create_page_directory($page_name);
}

/*
 * Create the .INC files
 */
$page_directory = $admin_includes_directory->get_page_directory($page_name);

$page_directory->create_inc_files($copyright_holder);
?>
