<?php
/**
 * Database_SQLDeleteStatement
 *
 * @copyright Clear Line Web Design, 2006-11-24
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/sql-statements/'
    . 'Database_SQLStatement.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/sql-statements/'
    . 'Database_SQLStatementWithWhereClause.inc.php';

class
    Database_SQLDeleteStatement
extends
    Database_SQLStatement
implements
    Database_SQLStatementWithWhereClause
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