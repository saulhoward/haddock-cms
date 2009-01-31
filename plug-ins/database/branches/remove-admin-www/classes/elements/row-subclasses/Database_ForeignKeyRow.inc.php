<?php
/**
 * Database_ForeignKeyRow
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Row.inc.php';
    
class
    Database_ForeignKeyRow
extends
    Database_Row
{
    /**
     * Remember:
     *
     * SELECT foo.bar AS foo__bar ...
     *
     * get it to work.
     */
    public function
        get($field_name)
    {
        if (preg_match('/^(\w+)(?:\.|__)(\w+)$/', $field_name, $matches)) {
            $table_name = $matches[1];
            $just_field_name = $matches[2];
            
            return parent::get($table_name . '__' . $field_name);
        } else {
            return parent::get($field_name);
        }
    }
}
?>
