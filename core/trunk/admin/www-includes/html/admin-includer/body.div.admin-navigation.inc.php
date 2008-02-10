<?php
/**
 * Navigation panel for the admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-20
 */

$navigation_div = new HTMLTags_Div();
$navigation_div->set_attribute_str('id', 'navigation');

#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
#$pd = $pdf->get_project_directory_for_this_project();
#
#$anxf = $pd->get_admin_navigation_xml_file();
#
#$site_map_ul = new Admin_SiteMapUL($anxf);
#
#$navigation_div->append_tag_to_content($site_map_ul);

ob_start();
require PROJECT_ROOT
	. '/haddock/admin/www-includes/html/'
	. 'body.div.nav-or-error-msg.inc.php';
$str = ob_get_clean();
$navigation_div->append_str_to_content($str);

echo $navigation_div->get_as_string();
?>
