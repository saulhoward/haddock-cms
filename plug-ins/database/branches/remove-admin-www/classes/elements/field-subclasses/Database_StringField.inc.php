<?php
/**
 * Database_StringField
 *
 * @copyright Clear Line Web Design, 2007-01-31
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Field.inc.php';

abstract class
    Database_StringField
extends
    Database_Field
{
    public function
        get_assignment_clause($value)
    {
        $assignment_clause = ' ';
        
        $assignment_clause .= $this->get_name();
        
        $assignment_clause .= ' = ';
        
        #$assignment_clause .= '"' . $value . '"';
        $assignment_clause .= '\'' . addslashes($value) . '\'';
        
        #echo "\$assignment_clause: $assignment_clause\n";
        
        $assignment_clause .= ' ';
        
        return $assignment_clause;
    }
    
    public function
        process_value($value)
    {
        return stripslashes($value);
    }
}
?>
