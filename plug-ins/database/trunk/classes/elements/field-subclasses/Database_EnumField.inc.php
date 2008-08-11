<?php
/**
 * Database_EnumChoiceField
 *
 * @copyright 2006-09-21, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/field-subclasses/'
#    . 'Database_StringField.inc.php';
#    
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/field-subclasses/'
#    . 'Database_ChoiceField.inc.php';

/**
 * A class to represent an ENUM field in a database table.
 */
class
    Database_EnumField
extends
    Database_StringField
implements
    Database_ChoiceField
{
    public function
        get_options()
    {      
        $enum_values = $this->get_type();
        
        #echo "$enum_values\n";
        
        $options = array();
        
        $enum_values = preg_replace('/^enum\(/i', '', $enum_values);
        $enum_values = rtrim($enum_values, ')');
        
        $options = explode(',', $enum_values);
        
        for($i = 0; $i < count($options); $i++) {
            if (
                preg_match(
                    "/^\s*'(.+)'\s*\$/",
                    $options[$i],
                    $matches
                )
            ) {
                #print_r($matches);
                $options[$i] = $matches[1];
            }
        }
        
        #print_r($options);
        
        return $options;
    }
    
    /**
     * Refactor the method above at some point.
     */
    public static function
        parse_type_for_options($type)
    {
        $options = array();
        
        $enum_values = $type;
        
        $enum_values = preg_replace('/^enum\(/i', '', $enum_values);
        $enum_values = rtrim($enum_values, ')');
        
        $options = explode(',', $enum_values);
        
        for($i = 0; $i < count($options); $i++) {
            if (
                preg_match(
                    "/^\s*'(.+)'\s*\$/",
                    $options[$i],
                    $matches
                )
            ) {
                #print_r($matches);
                $options[$i] = $matches[1];
            }
        }
        
        #print_r($options);
        
        return $options;
    }
}
?>