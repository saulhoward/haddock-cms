<?php
/**
 * Links to the admin pages for the other modules.
 *
 * @copyright Clear Line Web Design, 2007-01-08
 */

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/admin/classes/html-tags/'
    . 'Admin_ModuleLinksUL.inc.php';

/**
 * The contents of this panel.
 */
$tabs_div = new HTMLTags_Div();
$tabs_div->set_attribute_str('id', 'tabs');

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$module_links_ul = new Admin_ModuleLinksUL($project_directory);

$tabs_div->append_tag_to_content($module_links_ul);

echo $tabs_div->get_as_string();
?>
