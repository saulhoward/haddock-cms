<?php
/**
 * The header of the body.
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
#$project_directory = $pdf->get_project_directory_for_this_project();
#
#$config_file = $project_directory->get_config_file();

/*
 * Find the module config manager.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$config_manager = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

/*
 * Create the HTML tags objects.
 */
$div_header = new HTMLTags_Div();
$div_header->set_attribute_str('id', 'header');

$h1_title = new HTMLTags_Heading(1);

#$home_link = new HTMLTags_A($config_file->get_project_title());

#$element_names = array('project', 'name');
#
#if ($config_manager->has_nested_config_variable($element_names)) {
#	$home_link = new HTMLTags_A($config_manager->get_nested_config_variable($element_names));
#	
#	$home_link->set_href(new HTMLTags_URl('/'));
#
#	$h1_title->append_tag_to_content($home_link);
#
#	$div_header->append_tag_to_content($h1_title);
#
#	echo $div_header->get_as_string();
#}

$home_link = new HTMLTags_A($config_manager->get_project_name());

$home_link->set_href(new HTMLTags_URl('/'));

$h1_title->append_tag_to_content($home_link);

$div_header->append_tag_to_content($h1_title);

echo $div_header->get_as_string();
?>
