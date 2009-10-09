<?php
/**
 * Header div of the login page for the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 * @copyright 2009-10-08, Robert Impey
 */

$header_div = new HTMLTags_Div();
$header_div->set_attribute_str('id', 'header');

/* Code copied from new style Admin_HTMLPage
 * to give old-style admin pages the same look
 */
$image_div = new HTMLTags_Div();
$image_div->set_attribute_str('id', 'logo_image');
$logo_img = new HTMLTags_IMG();
$logo_src_url = new HTMLTags_URL();

$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();

/*
 * The admin module has been moved to the plug-ins directory.
 * RFI 2009-10-08
 */
#$config_manager = $cmf->get_config_manager('haddock', 'admin');
$config_manager = $cmf->get_config_manager('plug-ins', 'admin');

$logo_config_filename = $config_manager->get_logo_image_filename();
$logo_src_url->set_file($logo_config_filename);
$logo_img->set_src($logo_src_url);
$image_div->append($logo_img);
$header_div->append($image_div);
$h1_title = new HTMLTags_Heading(1);
$home_link = new HTMLTags_A(HaddockProjectOrganisation_ProjectInformationHelper::get_title());
$home_link->set_href(new HTMLTags_URl('/'));
$h1_title->append_tag_to_content($home_link);
$header_div->append($h1_title);

$header_div->append_tag_to_content(new HTMLTags_Heading(2, 'Login'));

echo $header_div->get_as_string();
?>
