<?php
/**
 * The file that produces the navigation XML file.
 *
 * @copyright Clear Line Web Design, 2007-08-18
 */

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$pd = $pdf->get_project_directory_for_this_project();
//$psd = $pd->get_project_specific_directory();
//
//if ($psd->has_admin_navigation_xml_file()) {
//    $anxf = $psd->get_admin_navigation_xml_file();
//    
//    echo $anxf->get_contents();
//} else {
//    $anxf = $pd->generate_admin_navigation_xml_file();
//    
//    echo $anxf->get_as_string();
//}

$anxf = $pd->get_admin_navigation_xml_file();
   
echo $anxf->get_as_string();

?>
