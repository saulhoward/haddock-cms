<?php
/**
 * The Disk Usage Admin Page
 *
 * @copyright Clear Line Web Design, 2007-02-14
 */

#/*
# * Define the classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TR.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TH.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TD.inc.php';

/*
 * Make the content div.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Make the disk usage table.
 */
$d_u_table = new HTMLTags_Table();

/*
 * Make the heading row.
 */
$heading_row = new HTMLTags_TR();

$heading_row->append_tag_to_content(new HTMLTags_TH('Item'));
$heading_row->append_tag_to_content(new HTMLTags_TH('Disk Usage (MB)'));

$d_u_table->append_tag_to_content($heading_row);

/*
 * The disk usage of the project directory.
 */
$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$p_d_row = new HTMLTags_TR();

$p_d_row->append_tag_to_content(new HTMLTags_TD('Project Directory'));

$p_d_d_u = $project_directory->get_disk_usage();

$p_d_d_u /= pow(2, 10);

$p_d_row->append_tag_to_content(
    new HTMLTags_TD(sprintf("%.3f", $p_d_d_u))
);

$d_u_table->append_tag_to_content($p_d_row);

/*
 * The disk usage of the database.
 */
$d_b_row = new HTMLTags_TR();

$d_b_row->append_tag_to_content(new HTMLTags_TD('Databases'));

$mysql_user = $project_directory->get_mysql_user();

$database = $mysql_user->get_database();

$d_b_d_u = $database->get_disk_usage();

$d_b_d_u /= pow(2, 10);

$d_b_row->append_tag_to_content(
    new HTMLTags_TD(sprintf("%.3f", $d_b_d_u))
);

$d_u_table->append_tag_to_content($d_b_row);

/*
 * The total disk usage.
 */
$total_row = new HTMLTags_TR();

$total_row->append_tag_to_content(new HTMLTags_TD('Total'));

$total_row->append_tag_to_content(
    new HTMLTags_TD(sprintf("%.3f", ($p_d_d_u + $d_b_d_u)))
);

$d_u_table->append_tag_to_content($total_row);

$content_div->append_tag_to_content($d_u_table);

/*
 * Display the content div.
 */
echo $content_div->get_as_string();
?>
