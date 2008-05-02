<?php
/**
 * Database_SQLUpdateStatement
 *
 * @copyright 2006-11-24, RFI
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_SQLStatement.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_SQLStatementWithWhereClause.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_SQLStatementWithSetClause.inc.php';
    
class
    Database_SQLUpdateStatement
extends
    Database_SQLStatement
implements
    Database_SQLStatementWithWhereClause,
    Database_SQLStatementWithSetClause
{
    public function
        assemble()
    {
    }
    
    protected function
        set_behaviours()
    {
        
    }
    
    public function
        add_key_value_pairs_to_set_clause(
            $key_value_pairs
        )
    {
    }
    
    public function
        get_set_clause()
    {
    }
    
    public function
        add_conditions_to_where_clause(
            $conditions
        )
    {
        
    }

    public function
        get_where_clause()
    {
        
    }
}
?>