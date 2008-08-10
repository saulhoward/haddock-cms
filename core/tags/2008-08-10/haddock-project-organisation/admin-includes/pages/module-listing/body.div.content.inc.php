<?php
/**
 * The content of the page that lists all the installed modules for
 * this project.
 *
 * @copyright Clear Line Web Design, 2007-05-15
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder
        ::get_instance();

$project_directory
    = $project_directory_finder
        ->get_project_directory_for_this_project();

/*
 * The core modules.
 */
$core_module_directories
    = $project_directory->get_core_module_directories();

$content_div->append_tag_to_content(new HTMLTags_Heading(3, 'Core Modules'));

$c_m_ul = new HTMLTags_UL();

foreach ($core_module_directories as $c_m_d) {
    $c_m_d_li = new HTMLTags_LI();
    
    $c_m_d_li->append_str_to_content($c_m_d->basename());
    
    $c_m_ul->add_li($c_m_d_li);
}

$content_div->append_tag_to_content($c_m_ul);

/*
 * The plug-in modules.
 */
$plug_in_module_directories =
    $project_directory->get_plug_in_module_directories();

$content_div->append_tag_to_content(new HTMLTags_Heading(3, 'Plug-in Modules'));

$pi_m_ul = new HTMLTags_UL();

foreach ($plug_in_module_directories as $pi_m_d) {
    $pi_m_d_li = new HTMLTags_LI();
    
    $pi_m_d_li->append_str_to_content($pi_m_d->basename());
    
    $pi_m_ul->add_li($pi_m_d_li);
}

$content_div->append_tag_to_content($pi_m_ul);

echo $content_div->get_as_string();
?>
