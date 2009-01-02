<?php
/**
 * Title div for the header of an admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

/* Code copied from new style Admin_HTMLPage
 * to give old-style admin pages the same look
 */
$image_div = new HTMLTags_Div();
$image_div->set_attribute_str('id', 'logo_image');
$logo_img = new HTMLTags_IMG();
$logo_src_url = new HTMLTags_URL();
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$config_manager = 
	$cmf->get_config_manager('haddock', 'admin');
$logo_config_filename = $config_manager->get_logo_image_filename();
$logo_src_url->set_file($logo_config_filename);
$logo_img->set_src($logo_src_url);
$image_div->append($logo_img);
echo $image_div->get_as_string();
$h1_title = new HTMLTags_Heading(1);
$home_link = new HTMLTags_A(HaddockProjectOrganisation_ProjectInformationHelper::get_title());
$home_link->set_href(new HTMLTags_URl('/'));
$h1_title->append_tag_to_content($home_link);
echo $h1_title->get_as_string();



$gvm = Caching_GlobalVarManager::get_instance();

echo "<h2>\n";
//
//echo "Admin\n";
//
//echo "&nbsp;&gt;&nbsp;\n";

#echo $current_module_directory->get_admin_section_title();

#echo "\n";

#print_r($current_admin_page_directory);

//if (isset($current_admin_page_directory)) {
//    echo "&nbsp;&gt;&nbsp;\n";
//    
//    echo $current_admin_page_directory->get_title();
//    
//    echo "\n";
//}

$page_directory = $gvm->get('current-admin-page-directory');

echo $page_directory->get_title();

echo "</h2>\n";
?>
