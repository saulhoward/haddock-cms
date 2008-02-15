<?php
/**
 * ServerAdminScripts_LocalControlCentre
 *
 * @copyright Clear Line Web Design, 2007-04-29
 */

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_ControlCentre.inc.php';
    
class
    ServerAdminScripts_LocalControlCentre
extends
    ServerAdminScripts_ControlCentre
{
    private $database;
    
    public function
        __construct()
    {
        $mysql_user_factory = Database_MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_project();
        $this->database = $mysql_user->get_database();
    }
    
    /**
     * This method gets the info from a local database.
     */
    public function
        count_current(
            $task,
            $system,
            $host
        )
    {
    }
    
    public function
        start(
            $task,
            $system,
            $host
        )
    {
        #echo "\$task: $task\n";
        #echo "\$system: $system\n";
        #echo "\$host: $host\n";
        
        $tasks_table = $this->database->get_table('ps_tasks');
        $systems_table = $this->database->get_table('ps_systems');
        $hosts_table = $this->database->get_table('ps_hosts');
        
        $task_id = $tasks_table->get_id_for_task($task);
        $system_id = $systems_table->get_id_for_system($system);
        $host_id = $hosts_table->get_id_for_host($host);
        
        $task_events_table = $this->database->get_table('ps_task_events');
        
        $values['host_id'] = $host_id;
        $values['task_id'] = $task_id;
        $values['system_id'] = $system_id;
        $values['start'] = 'NOW()';
        
        return $task_events_table->add($values);
    }
        
    public function
        finish($task_event_id)
    {
        $values['finish'] = 'NOW()';
        
        $task_events_table = $this->database->get_table('ps_task_events');
        
        $task_events_table->update_by_id($task_event_id, $values);
        
        $row = $task_events_table->get_row_by_id($task_event_id);
        
        return $row->get('ps_task_events__finish');
    }
    
    /**
     * Does this need to be able to list just the events
     * for a subselection?
     *
     * i.e. Should we be able to set
     *  - $system
     *  - $host
     *  - $task
     * ?
     */
    public function
        get_current_task_events()
    {
#        $query = <<<SQL
#SELECT
#    ps_task_events.*,
#    ps_hosts.*,
#    ps_systems.*,
#    ps_tasks.*
#FROM
#    ps_task_events,
#    ps_hosts,
#    ps_systems,
#    ps_tasks
#WHERE
#    ps_task_events.host_id = ps_hosts.id
#    AND
#    ps_task_events.system_id = ps_systems.id
#    AND
#    ps_task_events.task_id = ps_tasks.id
#    AND
#    ps_task_events.finish = '0000-00-00 00:00:00'
#ORDER BY
#    ps_task_events.start DESC
#SQL;

#        $query = <<<SQL
#SELECT
#    ps_task_events.*,
#    ps_hosts.name AS host_name,
#    ps_systems.name AS system_name,
#    ps_tasks.name AS task_name
#FROM
#    ps_task_events
#        INNER  JOIN ps_hosts
#            ON
#                ps_task_events.host_id = ps_hosts.id
#        INNER  JOIN ps_systems
#            ON
#                ps_task_events.system_id = ps_systems.id
#        INNER  JOIN ps_tasks
#            ON
#                ps_task_events.task_id = ps_tasks.id
#WHERE
#    ps_task_events.finish = '0000-00-00 00:00:00'
#ORDER BY
#    ps_task_events.start DESC
#SQL;
#
#        $task_events_table = $this->database->get_table('ps_task_events');
#        
#        return $task_events_table->get_rows_for_select($query);

        $task_events_table = $this->database->get_table('ps_task_events');
        
        $conditions['ps_task_events__finish'] = '0000-00-00 00:00:00';
        
        return $task_events_table->get_rows_where($conditions);
    }
}
?>
