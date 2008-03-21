<?php
/**
 * Database_SQLInsertStatement
 *
 * @copyright Clear Line Web Design, 2006-11-24
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/sql-statements/'
    . 'Database_SQLStatement.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/sql-statements/'
    . 'Database_SQLStatementWithSetClause.inc.php';
   
class
    Database_SQLInsertStatement
extends
    Database_SQLStatement
implements
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
}
?>
