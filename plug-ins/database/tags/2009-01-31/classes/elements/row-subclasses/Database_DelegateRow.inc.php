<?php
/**
 * Database_DelegateRow
 *
 * @copyright Clear Line Web Design, 2006-12-04
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Row.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/delegation/behaviours/'
#    . 'Database_RowBehaviour.inc.php';

abstract class
    Database_DelegateRow
extends
    Database_Row
{
    private $behaviours;
    
    public function __construct($table, $field_values)
    {
        parent::__construct($table, $field_values);
        
        $this->behaviours = array();
        
        $this->set_behaviours();
    }
    
    protected function add_behaviour($behaviour_name, Database_RowBehaviour $behaviour)
    {
        if (array_key_exists($behaviour_name, $this->behaviours)) {
            throw new Exception("Unable to set behaviour $behaviour_name more than once!");
        } else {
            $this->behaviours[$behaviour_name] = $behaviour;
        }
    }
    
    private function get_behaviour($behaviour_name)
    {
        if (array_key_exists($behaviour_name, $this->behaviours)) {
            return $this->behaviours[$behaviour_name];
        } else {
            $reflection_class = new ReflectionClass($this);
            
            $error_message = $reflection_class->getName();
            
            $error_message .= " doesn't have a behaviour called $behaviour_name!";
            
            throw new Exception($error_message);
        }
    }
    
    protected function run_behaviour($behaviour_name)
    {
        $behaviour = $this->get_behaviour($behaviour_name);
        
        $returned = $behaviour->run();
        
        if (isset($returned)) {
            return $returned;
        }
    }
    
    abstract protected function set_behaviours();
}
?>
