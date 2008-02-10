<?php
/**
 * Content of the page for refreshing the __autoload
 * function .INC file.
 *
 * @copyright Clear Line Web Design, 2007-05-11
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();
    
$project_specific_directory = $project_directory->get_project_specific_directory();

$autoload_inc_file
    = $project_specific_directory->get_autoload_inc_file();
    
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$autoload_inc_file = $project_specific_directory->get_autoload_inc_file();

$last_modified_p = new HTMLTags_P();

$last_modified_p->append_str_to_content('The <code>__autoload()</code> .INC file was last modified on ');

$last_modified_p->append_str_to_content(date('r', $autoload_inc_file->mtime()));

$content_div->append_tag_to_content($last_modified_p);

$refresh_a = new HTMLTags_A('Refresh');

$refresh_url = new HTMLTags_URL();

$refresh_url->set_file('/admin/redirect-script.php');

$refresh_url->set_get_variable('module', 'haddock-project-organisation');
$refresh_url->set_get_variable('page', 'autoload-inc-file-creation');
$refresh_url->set_get_variable('refresh');

$refresh_a->set_href($refresh_url);

$content_div->append_tag_to_content($refresh_a);

echo $content_div->get_as_string();
?>
