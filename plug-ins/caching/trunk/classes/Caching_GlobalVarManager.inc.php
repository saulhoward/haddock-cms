<?php
/**
 * Caching_GlobalVarManager
 *
 * @copyright Clear Line Web Design, 2007-07-25
 */

/**
 * A way to look after variables that are used globally.
 *
 * This is safer than using the "global" keyword or putting things into
 * the $_SESSION array as if an element is requested that has not been
 * set, an exception is thrown.
 *
 * Uses the singleton pattern.
 */
class
    Caching_GlobalVarManager
{
    private static $instance = NULL;
    
    private $variables;
    
    private function
        __construct()
    {
        $this->variables = array();
    }
    
    public static function
        get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new Caching_GlobalVarManager();
        }
        
        return self::$instance;
    }
    
    public function
        set($name, $variable)
    {
        $this->variables[$name] = $variable;
    }
    
    public function
        is_set($name)
    {
        return isset($this->variables[$name]);
    }
    
    public function
        get($name)
    {
        if ($this->is_set($name)) {
            return $this->variables[$name];
        } else {
            throw new Exception("No variable called \"$name\" set in Caching_GlobalVarManager!");
        }
    }
}
?>
