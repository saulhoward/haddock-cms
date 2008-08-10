<?php
/**
 * How users are finding the web site.
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Table.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TR.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TD.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_A.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

/*
 * Start the displayed content.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$server_logs_table = $database->get_table('hc_logging_server_logs');

$entrances = $server_logs_table->get_entrances();

$entrances_table = new HTMLTags_Table();

foreach ($entrances as $entrance) {
    $tr = new HTMLTags_TR();
    
    $td = new HTMLTags_TD();
    
    $tr->append_tag_to_content(new HTMLTags_TD($entrance['domain']));
    
    #$entrance_a = new HTMLTags_A($entrance['domain']);
    #
    #$entrance_a->set_href(new HTMLTags_URL($entrance['domain']));
    #
    #$entrance_a->set_attribute_str('target', '_blank');
    #
    #$td->append_tag_to_content($entrance_a);
    #
    #$tr->append_tag_to_content($td);
    
    $tr->append_tag_to_content(new HTMLTags_TD($entrance['count']));
    
    $entrances_table->append_tag_to_content($tr);
}

$content_div->append_tag_to_content($entrances_table);

echo $content_div->get_as_string();
?>
