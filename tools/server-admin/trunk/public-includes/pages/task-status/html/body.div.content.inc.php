<?php
/**
 * Content of the page that list the task that are currently running
 * in the server admin scripts project.
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_LocalControlCentre.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Heading.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Table.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TR.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TH.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TD.inc.php';

$control_centre = new ServerAdminScripts_LocalControlCentre();

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$content_div->append_tag_to_content(new HTMLTags_Heading(2, 'Current Tasks'));

$tasks_table = new HTMLTags_Table();

$tasks_tr = new HTMLTags_TR();

$tasks_tr->append_tag_to_content(new HTMLTags_TH('Task Event ID'));
$tasks_tr->append_tag_to_content(new HTMLTags_TH('Host'));
$tasks_tr->append_tag_to_content(new HTMLTags_TH('System'));
$tasks_tr->append_tag_to_content(new HTMLTags_TH('Task'));
$tasks_tr->append_tag_to_content(new HTMLTags_TH('Start'));

$tasks_table->append_tag_to_content($tasks_tr);

$current_task_events = $control_centre->get_current_task_events();

foreach ($current_task_events as $current_task_event) {
    $tasks_tr = new HTMLTags_TR();
    
    $tasks_tr->append_tag_to_content(
        new HTMLTags_TD(
            #$current_task_event->get('ps_task_events__id')
            $current_task_event->get('ps_task_events.id')
        )
    );
    
    $tasks_tr->append_tag_to_content(
        new HTMLTags_TD(
            #$current_task_event->get('ps_hosts__name')
            $current_task_event->get('ps_hosts.name')
        )
    );
    
    $tasks_tr->append_tag_to_content(
        new HTMLTags_TD(
            #$current_task_event->get('ps_systems__name')
            $current_task_event->get('ps_systems.name')
        )
    );
    
    $tasks_tr->append_tag_to_content(
        new HTMLTags_TD(
            #$current_task_event->get('ps_tasks__name')
            $current_task_event->get('ps_tasks.name')
        )
    );
    
    $tasks_tr->append_tag_to_content(
        new HTMLTags_TD(
            #$current_task_event->get('ps_task_events__start')
            $current_task_event->get('ps_task_events.start')
        )
    );
    
    $tasks_table->append_tag_to_content($tasks_tr);
}

$content_div->append_tag_to_content($tasks_table);

echo $content_div->get_as_string();
?>
