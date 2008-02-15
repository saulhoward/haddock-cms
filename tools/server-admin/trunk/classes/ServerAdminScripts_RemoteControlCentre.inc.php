<?php
/**
 * ServerAdminScripts_RemoteControlCentre
 *
 * @copyright Clear Line Web Design, 2007-04-29
 */

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_ControlCentre.inc.php';

class
    ServerAdminScripts_RemoteControlCentre
extends
    ServerAdminScripts_ControlCentre
{
    private $control_centre_url;
    
    public function
        __construct($contol_centre_url)
    {
        $this->contol_centre_url = $contol_centre_url;
    }
    
    /**
     * This method gets the info from a remote server.
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
    }
        
    public function
        finish($task_event_id)
    {
    }
}
?>
