<?php
/**
 * The header div for the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */

/*
 * Create the singleton variables.
 */
#$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();
#$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();

#$header_div = new HTMLTags_Div();
#$header_div->set_attribute_str('id', 'header');

$customer_regions_header_div = new HTMLTags_Div();
$customer_regions_header_div->set_attribute_str('id', 'customer_regions_header');

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

#/*
# * A span for the logo (CSS hack).
# */
#$logo_span = new HTMLTags_Span();
#$header_div->append_tag_to_content($logo_span);

#/*
# * A heading that looks at the config file for this project.
# */
#$header_div_header_h = new HTMLTags_Heading(1);
#
#$header_div_header_h->set_attribute_str('class', 'header');
#$header_div_header_h->set_attribute_str('id', 'shop_title');
#
#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
#$project_directory = $pdf->get_project_directory_for_this_project();
#
#/*
# * Get the config managers.
# */
##$config_file = $project_directory->get_config_file();
#$hpo_cm = $cmf->get_config_manager('haddock', 'haddock-project-organisation');
##$shop_cm = $cmf->get_config_manager('plug-ins', 'shop');
#
#
##$header_div_header_h->append_str_to_content($config_file->get_project_title());
#$header_div_header_h->append_str_to_content($hpo_cm->get_project_name());
#
#$header_div->append_tag_to_content($header_div_header_h);

/*
 * The various regions where this shop sells products.
 */
#$header_div->append_str_to_content($page_manager->get_inc_file_as_string('body.div.customer-regions'));

/*
 * Show the customer regions.
 *
 * TO DO:
 * There should be a config variable that handles
 * whether the regions are shown or not.
 */
if (!$log_in_manager->is_logged_in())
{
	$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
	$customer_regions_table_renderer = $customer_regions_table->get_renderer();

	$customer_regions_header_div->append_tag_to_content(
		$customer_regions_table_renderer->get_customer_region_selection_div()
	);
}

echo $customer_regions_header_div->get_as_string();
?>
