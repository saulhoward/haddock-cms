<?php
/**
 * The title of the head.
 *
 * @copyright Clear Line Web Design, 2007-07-19
 */

/*
 * Find the module config manager.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$config_manager = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
#$project_directory = $pdf->get_project_directory_for_this_project();
#
#$config_file = $project_directory->get_config_file();
#
#$title = new HTMLTags_Title($config_file->get_project_title());

#$element_names = array('project', 'name');
#
#if ($config_manager->has_nested_config_variable($element_names)) {
#	$title = new HTMLTags_Title($config_manager->get_nested_config_variable($element_names));
#
#	echo $title->get_as_string();
#}
$title = new HTMLTags_Title($config_manager->get_project_name());
echo $title->get_as_string();
?>

