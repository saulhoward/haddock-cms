<?php
/**
 * Lists the modules that are installed for this project.
 *
 * @copyright Clear Line Web Design, 2007-05-15
 */

$dom = new DOMDocument('1.0', 'UTF-8');

$modules_element = $dom->createElement('modules');
$dom->appendChild($modules_element);

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder
        ::get_instance();

$project_directory
    = $project_directory_finder
        ->get_project_directory_for_this_project();

if (isset($_GET['core'])) {
    $core_element = $dom->createElement('core');
    $modules_element->appendChild($core_element);
    
    $core_module_directories
        = $project_directory->get_core_module_directories();
        
    foreach ($core_module_directories as $c_m_d) {
        $module_element = $dom->createElement('module');
        $core_element->appendChild($module_element);
        
        $module_element->setAttribute('name', $c_m_d->basename());
    }
}

if (isset($_GET['plug-ins'])) {
    $plug_ins_element = $dom->createElement('plug_ins');
    $modules_element->appendChild($plug_ins_element);
    
    $plug_in_module_directories =
        $project_directory->get_plug_in_module_directories();
        
    foreach ($plug_in_module_directories as $pi_m_d) {
        $module_element = $dom->createElement('module');
        $plug_ins_element->appendChild($module_element);
        
        $module_element->setAttribute('name', $pi_m_d->basename());
    }
}

echo $dom->saveXML();
?>
