<?php
/**
 * ServerAdminScripts_ControlCentre
 *
 * @copyright Clear Line Web Design, 2007-04-27
 */

/**
 * Should this be the subclass of something?
 * Do we need a remote call/curl module in the
 * haddock core?
 */
abstract class
    ServerAdminScripts_ControlCentre
{
    public function
        __construct()
    {
    }
    
    /**
     * Tells you how many scripts that are running
     * at the moment that are dumping the data from
     * some system (mysql, svn) to a back up file
     * on a given host.
     */
    public abstract function
        count_current(
            $task,
            $system,
            $host
        );
    
    /**
     * Called when a task is started.
     */
    public abstract function
        start(
            $task,
            $system,
            $host
        );
        
    /**
     * Tells the control centre that we've finished the
     * task.
     *
     * Is it a mistake to finish a task event twice?
     * Should an exception be thrown in that case?
     */
    public abstract function
        finish($task_event_id);
}
?>
