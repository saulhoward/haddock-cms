<?php
/**
 * The XML file for the class-list page in
 * the haddock-project-organisation module of
 * the admin section.
 *
 * @copyright Clear Line Web Design, 2007-05-09
 */

#print_r($_GET);
#exit;

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
    
$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

if (isset($_GET['parent_class_name'])) {
    #echo $_GET['parent_class_name'] . "\n";
    #exit;
    
    #$php_class_files = array();
    $php_class_files = $project_directory->get_php_subclass_files(
        $_GET['parent_class_name']
    );
} else {
    $php_class_files = $project_directory->get_php_class_files();
}

$dom_document = new DOMDocument('1.0', 'UTF-8');

$classes_element = $dom_document->createElement('php_classes');

$dom_document->appendChild($classes_element);

foreach ($php_class_files as $p_c_f) {
    $class_element = $dom_document->createElement('php_class');
    $classes_element->appendChild($class_element);
    
    $class_element->setAttribute('php_class_name', $p_c_f->get_php_class_name());
    
    $filename_element = $dom_document->createElement(
        'filename',
        $p_c_f->get_name_relative_to_dir(PROJECT_ROOT)
    );
    $class_element->appendChild($filename_element);
    
    #$reflection_class = $p_c_f->get_reflection_class();
    
    #print_r($reflection_class);
    #echo $reflection_class->getName() . "\n";
    
    #$parent_reflection_class = $reflection_class->getParentClass();
    
    ##print_r($parent_reflection_class);
    ##echo $parent_reflection_class->getName() . "\n";
    #echo $parent_reflection_class->isAbstract() . "\n";
    #
    #if (isset($parent_reflection_class)) {
    #    #$parent_class_element = $dom_document->createElement(
    #    #    'parent_class',
    #    #    $parent_reflection_class->getName()
    #    #);
    #    #$class_element->appendChild($parent_class_element);
    #}
}

echo $dom_document->saveXML();
?>
