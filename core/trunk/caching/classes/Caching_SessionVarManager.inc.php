<?php
/**
 * Caching_SessionVarManager
 *
 * @copyright Clear Line Web Design, 2007-08-26
 */

/**
 * A wrapper class that sits around the $_SESSION array.
 *
 * Of course, you can still access variables in that array.
 *
 * It just makes things a little safer.
 *
 * See:
 *
 * http://wiki.haddock-cms.com/index.php/Caching_SessionVarManager
 */
class
    Caching_SessionVarManager
{
    private static $instance;
    
    private $debug;
    
    private function
        __construct()
    {
        if (!isset($_SESSION['caching-session-var-manager-data'])) {
            $_SESSION['caching-session-var-manager-data'] = array();
        }
        
        $this->debug = FALSE;
        #$this->debug = TRUE;
    }
    
    public static function
        get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Caching_SessionVarManager();
        }
        
        return self::$instance;
    }
    
    public function
        is_set($var_name)
    {
        return isset($_SESSION['caching-session-var-manager-data'][$var_name]);
    }
    
    public function
        set($var_name, $value)
    {
        if ($this->debug) {
            echo "Caching_SessionVarManager::set('$var_name', ...)\n";
            
            if (is_array($value) || is_object($value)) {
                echo 'print_r($value): ' . "\n";
                print_r($value);
            } else {
                echo "\$value: $value\n";
            }
        }
        
        $_SESSION['caching-session-var-manager-data'][$var_name] = $value;
    }
    
    public function
        get($var_name)
    {
        if ($this->is_set($var_name)) {
            $value = $_SESSION['caching-session-var-manager-data'][$var_name];
            
            if ($this->debug) {
                echo "Caching_SessionVarManager::get('$var_name')\n";
                
                if (is_array($value) || is_object($value)) {
                    echo 'print_r($value): ' . "\n";
                    print_r($value);
                } else {
                    echo "\$value: $value\n";
                }
            }
            
            return $value;
        } else {
            throw new Exception("No var called '$var_name' in the \$_SESSION array!");
        }
    }
    
    /**
     * @param string $var_name
     * @param boole $exception_on_not_set
     * 	Should an exception be thrown if the key isn't set?
     */
    public function
        delete(
	    $var_name,
	    $exception_on_not_set = TRUE
	)
    {
	if ($this->debug) {
	    echo "Caching_SessionVarManager::delete('$var_name')\n";
	}
	
	if ($exception_on_not_set && !$this->is_set($var_name)) {
	    throw new Exception("Cannot delete unset '$var_name' in the \$_SESSION array ");
	} else {
	    unset($_SESSION['caching-session-var-manager-data'][$var_name]);
	}
    }

	public function
		delete_matching($regex)
	{
		foreach (array_keys($_SESSION['caching-session-var-manager-data']) as $key) {
			if (preg_match($regex, $key)) {
				unset($_SESSION['caching-session-var-manager-data'][$key]);
			}
		}
	}
}
?>
