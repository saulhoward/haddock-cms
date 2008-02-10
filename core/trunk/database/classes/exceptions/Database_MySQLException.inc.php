<?php
/**
 * Database_MySQLException
 *
 * @copyright Clear Line Web Design, 2006-09-08
 */

/**
 * A class to get error codes and messages from
 * a database handle where something has just gone
 * wrong.
 */
class
    Database_MySQLException
extends
    Exception
{
    private $error_number;
    
    private $error_message;
    
    public function __construct($dbh)
    {
        $this->error_number = mysql_errno($dbh);
        
        $this->error_message = mysql_error($dbh);
        
        parent::__construct('MySQL Error: ' . $this->error_number . ' - ' . $this->error_message);
    }
    
    public function get_error_number()
    {
        return $this->error_number;
    }
    
    public function get_error_message()
    {
        return $this->error_message;
    }
}
?>