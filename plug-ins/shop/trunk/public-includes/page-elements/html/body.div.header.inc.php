<?php
/**
 * The header div for the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */
$page_manager = PublicHTML_PageManager::get_instance();

$header_div = new HTMLTags_Div();
$header_div->set_attribute_str('id', 'header');

/*
 * A span for the logo (CSS hack).
 */
$logo_span = new HTMLTags_Span();
$header_div->append_tag_to_content($logo_span);

/*
 * A heading that looks at the config file for this project.
 */
$header_div_header_h = new HTMLTags_Heading(1);

$header_div_header_h->set_attribute_str('class', 'header');
$header_div_header_h->set_attribute_str('id', 'shop_title');

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory = $pdf->get_project_directory_for_this_project();
$config_file = $project_directory->get_config_file();
$header_div_header_h->append_str_to_content($config_file->get_project_title());

$header_div->append_tag_to_content($header_div_header_h);

/*
 * The various regions where this shop sells products.
 */
$header_div->append_str_to_content($page_manager->get_inc_file_as_string('body.div.customer-regions'));

echo $header_div->get_as_string();
?>
