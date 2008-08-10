<?php
/**
 * The args for the create-new-admin-page script.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Create the singleton objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();

/*
 * Get the HPO CM.
 */
$hpo_cm = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

$section_and_module
    = HaddockProjectOrganisation_CLIModuleDirectoryFinder
        ::find_section_and_module(
            $args,
            'page-section',
            "In which section do you want to save the new page?\n",
            'page-module',
            "In which module do you want to save the new page?\n"
        );

$page_section = $section_and_module['section'];

$page_module = NULL;
if (isset($section_and_module['module'])) {
    $page_module = $section_and_module['module'];
}

if (isset($args['page-name'])) {
    $page_name = $args['page-name'];
} else {
    echo "Please enter a name for the page:\n";
    $page_name = trim(fgets(STDIN));
}

if (isset($args['copyright-holder'])) {
    $copyright_holder = $args['copyright-holder'];
} else {
    $copyright_holder = $hpo_cm->get_copyright_holder();
}

if (!$silent) {
    echo "The section in which to save the page: $page_section\n";
    
    if (isset($page_module)) {
        echo "The module in which to save the page: $page_module\n";
    }
    
    echo "The name of the page: $page_name\n";
    
    echo "The copyright holder: $copyright_holder\n";
}

?>
