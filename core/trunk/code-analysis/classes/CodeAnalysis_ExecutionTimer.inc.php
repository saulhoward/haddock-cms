<?php
/**
 * CodeAnalysis_ExecutionTimer
 *
 * @copyright Clear Line Web Design, 2006-11-14
 */

/**
 * A class that can be used for timing PHP execution.
 *
 * Uses the Singleton Pattern.
 */
class CodeAnalysis_ExecutionTimer
{
    static private $instance = NULL;
    
    private $start;
    private $last_marker;
    
    private function __construct()
    {
        echo "Instanstiating: CodeAnalysis_ExecutionTimer ...\n";
        
        $this->start = microtime(TRUE);
        $this->last_marker = $this->start;
    }
    
    public static function get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new CodeAnalysis_ExecutionTimer();
        }
        
        return self::$instance;
    }
    
    public function get_start()
    {
        return $this->start;
    }
    
    public function get_last_marker()
    {
        return $this->last_marker;
    }
    
    public function set_last_marker($last_marker)
    {
        $this->last_marker = $last_marker;
    }
    
    public function get_interval_from_start_to($marker)
    {
        return $marker - $this->get_start();
    }

    public function get_interval_from_last_marker_to($marker)
    {
        return $marker - $this->get_last_marker();
    }
    
    public function mark()
    {
        $marker = microtime(TRUE);
        echo 'Time since start (s): ' . $this->get_interval_from_start_to($marker) . "\n";
        echo 'Time since previous timing marker (s): ' . $this->get_interval_from_last_marker_to($marker) . "\n";
        $this->set_last_marker($marker);
    }
}
?>
