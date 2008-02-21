<?php
/**
 * The content of the dumper-status page in the server-admin-scripts project.
 *
 * @copyright Clear Line Web Design, 2007-04-25
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_ControlCentre.inc.php';

$content_div = new HTMLTags_Div();

$content_div->set_attribute_str('id', 'content');

/*
 * List all the tasks that haven't been completed yet.
 */



echo $content_div->get_as_string();
?>