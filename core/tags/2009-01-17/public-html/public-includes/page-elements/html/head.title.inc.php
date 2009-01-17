<?php
/**
 * The title of the head.
 *
 * @copyright Clear Line Web Design, 2007-07-19
 */

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$project_directory = $pdf->get_project_directory_for_this_project();

$config_file = $project_directory->get_config_file();

$title = new HTMLTags_Title($config_file->get_project_title());

echo $title->get_as_string();
?>

