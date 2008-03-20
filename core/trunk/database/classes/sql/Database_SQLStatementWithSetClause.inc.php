<?php
/**
 * Database_SQLStatementWithSetClause
 *
 * @copyright Clear Line Web Design, 2007-02-19
 */

interface
    Database_SQLStatementWithSetClause
{
    /**
     * Implement using the behaviours.
     */
    public function
        add_key_value_pairs_to_set_clause(
            $key_value_pairs
        );
    
    /**
     * Simple accessor.
     */
    public function
        get_set_clause();
}
?>
