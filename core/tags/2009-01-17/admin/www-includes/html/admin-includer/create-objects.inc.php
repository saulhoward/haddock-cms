<?php
/**
 * Create the admin-includes directory.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Find the admin includes directory.
 */

$current_admin_includes_directory = NULL;

#print_r($_GET);exit;

if ($gvm->get('admin-section') == 'project-specific') {
    $psd = $project_directory->get_project_specific_directory();

    if ($psd->has_admin_includes_directory()) {
        $current_admin_includes_directory = $psd->get_admin_includes_directory();
    }
} else {
    if ($gvm->get('admin-section') == 'plug-ins') {
        #echo "Plug-ins\n";exit;
        $md = $project_directory->get_plug_in_module_directory($gvm->get('admin-module'));
    } else if ($gvm->get('admin-section') == 'haddock') {
        $md = $project_directory->get_core_module_directory($gvm->get('admin-module'));
    }

    if ($md->has_admin_includes_directory()) {
        $current_admin_includes_directory = $md->get_admin_includes_directory();
    }
}

/*
 * Find the admin page directory.
 */

$current_admin_page_directory = NULL;

if ($current_admin_includes_directory->has_page_directory($page_directory_basename)) {
    $current_admin_page_directory
        = $current_admin_includes_directory->get_page_directory($gvm->get('admin-page'));
}

/*
 * Check that we have a page.
 */
if (isset($current_admin_page_directory)) {
    $gvm->set('current-admin-page-directory', $current_admin_page_directory);
} else {
    $msg = 'No page called ' . $gvm->get('admin-page') . ' in the ';

    if ($gvm->get('admin-section') != 'project-specific') {
        $msg .= $gvm->get('admin-module') . ' module in the ';
    }

    $msg .= $gvm->get('admin-section') . ' section!';

    throw new Exception($msg);
}

/*
 * Create The Current URL
 */
$current_page_admin_url = $page_manager->get_current_url();
$current_page_admin_url->set_get_variable('admin-section', $_GET['admin-section']);
$current_page_admin_url->set_get_variable('admin-module', $_GET['admin-module']);
$current_page_admin_url->set_get_variable('admin-page', $_GET['admin-page']);

$gvm->set('current_page_admin_url', $current_page_admin_url);

$redirect_script_admin_url = clone $current_page_admin_url;
$redirect_script_admin_url->set_get_variable('type', 'redirect-script');

$gvm->set('redirect_script_admin_url', $redirect_script_admin_url);
?>
