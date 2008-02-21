<?php
/**
 * Check that the appropriate args have been set for the
 * find-inc-files script.
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

require_once PROJECT_ROOT
    . '/haddock/public-html/classes/'
    . 'PublicHTML_PageManager.inc.php';

/*
 * Set the section to search.
 */
if (isset($args['search-section'])) {
    $search_section = $args['search-section'];
} else {
    echo "The section to search must be set:\n";
    
    $search_section = CLIScripts_InputReader::get_choice_from_string('haddock plug-ins project-specific');
}

/*
 * Set the module to search.
 */
if ($search_section != 'project-specific') {
    if (isset($args['search-module'])) {
        $search_module = $args['search-module'];
    } else {
        if ($search_section == 'haddock') {
            $module_directories = $project_directory->get_core_module_directories();
        } else if ($search_section == 'plug-ins') {
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
        
        echo "The module to search must be set: \n";
        
        $search_module = CLIScripts_InputReader::get_choice_from_string($choice_str);
    }
} else {
    if (isset($args['search-module'])) {
        die("The search-module must not be set if the search-section is project-specific!\n");
    } 
}

if ($search_section == 'project-specific') {
    $module_directory = $project_directory->get_project_specific_directory();
} elseif ($search_section == 'haddock') {
    $module_directory = $project_directory->get_core_module_directory($search_module);
} elseif ($search_section == 'plug-ins') {
    $module_directory = $project_directory->get_plug_in_module_directory($search_module);
}

/*
 * Set the page to search.
 */
if (isset($args['search-page'])) {
    $search_page = $args['search-page'];
} else {
    echo "The page must be set:\n";
    
    $choice_str = '';
    
    $first = TRUE;
    foreach ($module_directory->get_public_page_directories() as $page_directory) {
        if ($first) {
            $first = FALSE;
        } else {
            $choice_str .= ' ';
        }
        
        $choice_str .= $page_directory->get_page_name();
    }
    
    $search_page = CLIScripts_InputReader::get_choice_from_string($choice_str);
}

$page_directory = $module_directory->get_public_page_directory($search_page);

/*
 * Set the type to search.
 */
if (isset($args['search-type'])) {
    $search_type = $args['search-type'];
} else {
    echo "The type must be set:\n";
    
    $choice_str = '';
    
    $first = TRUE;
    foreach ($page_directory->get_types() as $type) {
        if ($first) {
            $first = FALSE;
        } else {
            $choice_str .= ' ';
        }
        
        $choice_str .= $type;
    }
    
    $search_type = CLIScripts_InputReader::get_choice_from_string($choice_str);
}

$page_manager = PublicHTML_PageManager::get_instance();

$page_manager->set_section($search_section);

if ($search_section != 'project-specific') {
    $page_manager->set_module($search_module);
}

$page_manager->set_page($search_page);
$page_manager->set_type($search_type);

if (!$silent) {
    echo "The search section: $search_section\n";
    
    if (isset($search_module)) {
        echo "The search module: $search_module\n";
    }
    
    echo "The search page: $search_page\n";
    
    echo "The search type: $search_type\n";
}
?>
