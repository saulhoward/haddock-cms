<?php
/**
 * HTMLTags_AttributeWithValue
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_Attribute.inc.php';

class
    HTMLTags_AttributeWithValue
extends
    HTMLTags_Attribute
{
    private $value;
    
    public function __construct($name, $value)
    {
        parent::__construct($name);
        $this->value = $value;
    }
    
    public function get_value()
    {
        return $this->value;
    }
    
    public function get_as_string()
    {
        $name_value_string = '';
        
        $name_value_string .= $this->get_name();
        
        $name_value_string .= '=';
        
        $name_value_string .= '"';
        $name_value_string .= $this->get_value();
        $name_value_string .= '"';
        
        return $name_value_string;
    }
}
?>
