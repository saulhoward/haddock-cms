<?php
/**
 * ServerAdminScripts_TaskEventsTable
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/table-subclasses/'
    . 'Database_ForeignKeyTable.inc.php';

class
    ServerAdminScripts_TaskEventsTable
extends
    Database_ForeignKeyTable
{
    public static function
        get_foreign_key_table_names()
    {
        return array(
            'host_id' => 'ps_hosts',
            'task_id' => 'ps_tasks',
            'system_id' => 'ps_systems'
        );
    }
}
?>
