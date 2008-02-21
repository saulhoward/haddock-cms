<?php
/**
 * FileSystem_PHPClassFile
 *
 * @copy Clear Line Web Design, 2006-11-13
 */

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_PHPIncFile.inc.php';

/**
 * Represents a PHP Class File.
 *
 * Assumes that a class called
 *
 * Project_FooBar
 *
 * would be in a file called
 *
 * Project_FooBar.inc.php
 *
 * and that the file would define only one class.
 */
class
    FileSystem_PHPClassFile
extends
    FileSystem_PHPIncFile
{
    private $reflection_class;
    
    public function
        get_php_class_name()
    {
        $basename = basename($this->get_name());
        
        if (preg_match('/(\w+)\.inc\.php$/', $basename, $matches)) {
            return $matches[1];
        }
        
        return '';
    }
    
    public function
        declare_class()
    {
        require_once $this->get_name();
    }
    
    public function
        get_reflection_class()
    {
        if (!isset($this->reflection_class)) {
            $this->declare_class();
            
            $this->reflection_class
                = new ReflectionClass($this->get_php_class_name());
        }
        
        return $this->reflection_class;
    }
    
    public function
        cmp_php_class_names(
            FileSystem_PHPClassFile $a,
            FileSystem_PHPClassFile $b
        )
    {
        return strcasecmp($a->get_php_class_name(), $b->get_php_class_name());
    }
}
?>
