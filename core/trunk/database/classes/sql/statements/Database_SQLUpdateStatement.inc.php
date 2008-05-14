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
        echo __METHOD__ . "\n";
        
        $this->str = '';
        
        /*
         * The UPDATE clause.
         */
        $update_clause = $this->get_update_clause();
        
        #print_r($update_clause);
        #exit;
        
        $this->str .= $update_clause->get_as_string();
        
        /*
         * The SET clause.
         */
        $set_clause = $this->get_set_clause();
        
        #print_r($set_clause);
        #exit;
        
        $this->str .= $set_clause->get_as_string();
        
        /*
         * The WHERE clause.
         */
        $where_clause = $this->get_where_clause();
        
        #print_r($where_clause);
        #exit;
        
        $where_clause_str = $where_clause->get_as_string();
        
        #echo $where_clause_str; exit;
        
        $this->str .= $where_clause_str;
        
        $this->assembled = TRUE;
    }
    
    #protected function
    #    set_behaviours()
    #{
    #    
    #}
    
    public function
        add_key_value_pairs_to_set_clause(
            $key_value_pairs
        )
    {
        throw new Exception('Please override ' . __METHOD__ . '!');
    }
    
    public function
        get_set_clause()
    {
        throw new Exception('Please override ' . __METHOD__ . '!');
    }
    
    public function
        add_conditions_to_where_clause(
            $conditions
        )
    {
        throw new Exception('Please override ' . __METHOD__ . '!');
    }

    public function
        get_where_clause()
    {
        throw new Exception('Please override ' . __METHOD__ . '!');
    }
    
    protected function
        get_update_clause()
    {
        return
            new Database_SQLUpdateClause(
                $this->get_table_name()
            );
    }
    
    protected function
        get_table_name()
    {
        throw new Exception('Please override ' . __METHOD__ . '!');
    }
}
?>