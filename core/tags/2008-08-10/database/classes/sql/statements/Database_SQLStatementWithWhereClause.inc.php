<?php
/**
 * Database_SQLStatementWithWhereClause
 *
 * @copyright Clear Line Web Design, 2007-02-19
 */

interface
    Database_SQLStatementWithWhereClause
{
    /**
     * Should use the behaviour class.
     */
    public function
        add_conditions_to_where_clause(
            $conditions
        );
    
    /**
     * Simple accessor.
     */
    public function
        get_where_clause();
}
?>