<?php
/**
 * Included by the content of the navigation page for the admin section
 * and on each page in the navigation div.
 * 
 * @copyright Clear Line Web Design, 2007-10-21
 */

$nav_or_error_msg_div = new HTMLTags_Div();
$nav_or_error_msg_div->set_attribute_str('id', 'nav-or-error-msg');

/*
 * Does this project have a navigation.xml file yet?
 * 
 * see
 * http://wiki.haddock-cms.com/index.php/Admin_NavigationXMLFile
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$pd = $pdf->get_project_directory_for_this_project();
$psd = $pd->get_project_specific_directory();

$alm = Admin_LoginManager::get_instance();

if ($psd->has_admin_navigation_xml_file()) {
	$anxf = $psd->get_admin_navigation_xml_file();

	$site_map_ul = new Admin_SiteMapUL(
		$anxf,
		$alm->get_type()
	);

	$nav_or_error_msg_div->append_tag_to_content($site_map_ul);
} else {
	$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
	$cm = $cmf->get_config_manager('haddock', 'admin');

	/*
	 * Get the file not found message and turn it into paragraphs.
	 * 
	 * The first paragraph should set its CSS class to 'error'.
	 */
	#$fnfm_str = $cm->get_nested_config_variable_str('navigation file-not-found-msg');
	$fnfm_str = $cm->get_navigation_file_not_found_msg();

	$ps = HTMLTags_BLSeparatedPFactory::get_ps_from_str($fnfm_str);

	if (count($ps) > 0) {
		$ps[0]->set_attribute_str('class', 'error');

		foreach ($ps as $p) {
			$nav_or_error_msg_div->append_tag_to_content($p);
		}
	}
}

echo $nav_or_error_msg_div->get_as_string();
?>
