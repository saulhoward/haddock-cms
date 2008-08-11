<?php
/**
 * Database_MySQLRootUser
 *
 * @copyright Clear Line Web Design, 2007-01-28
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUser.inc.php';

class
    Database_MySQLRootUser
extends
    Database_MySQLUser
{
    public function
        has_password()
    {
        return isset($_SESSION['mysql-root-password']);
    }
    
    public function
        clear_password()
    {
        unset($_SESSION['mysql-root-password']);
    }
    
    public function
        get_dbh_no_db_selected()
    {
        $password_file = $this->get_password_file();
        
        $dbh = @mysql_pconnect(
            $password_file->get_host(),
            'root',
            $_SESSION['mysql-root-password']
        );
        
        if (!isset($dbh) or !@mysql_ping($dbh)) {
            throw new Exception(
                'Unable to connect as '
                . 'root'
                . '@'
                . $password_file->get_host()
                . '!'
            );
        }
        
        return $dbh;
    }
    
    public function
        has_database()
    {
        $password_file = $this->get_password_file();
        
        $database = $password_file->get_database();
        
        #echo "\$database: $database\n";
        
        $dbh = $this->get_dbh_no_db_selected();
        
        $db_list = mysql_list_dbs($dbh);
        
        while ($row = mysql_fetch_object($db_list)) {
            if ($row->Database == $database) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    public function
        create_database()
    {
        $password_file = $this->get_password_file();
        
        $database = $password_file->get_database();
        
        $dbh = $this->get_dbh_no_db_selected();
        
        $query = "CREATE DATABASE $database";
        
        mysql_query($query, $dbh);
        
        return $this->has_database();
    }
    
    public function
        has_user_for_this_project()
    {
        $dbh = $this->get_dbh_no_db_selected();
        
        mysql_select_db('mysql', $dbh);        
        
        $password_file = $this->get_password_file();
        
        $username = $password_file->get_username();
        
        $host = $password_file->get_host();
        
        $query = <<<SQL
SELECT
    COUNT(*)
FROM
    user
WHERE
    Host = '$host'
    AND
    User = '$username'
SQL;
        
        $result = mysql_query($query, $dbh);
        
        if ($row = mysql_fetch_array($result)) {
            return $row[0] > 0;
        }
        
        return FALSE;
    }
    
    public function
        create_user_for_this_project()
    {
        $dbh = $this->get_dbh_no_db_selected();
        
        mysql_select_db('mysql', $dbh);        
        
        $password_file = $this->get_password_file();
        
        $database = $password_file->get_database();
        $username = $password_file->get_username();
        $host = $password_file->get_host();
        $password = $password_file->get_password();
        
        $statement = <<<SQL
GRANT
    SELECT,
    UPDATE,
    INSERT,
    DELETE
ON
    `$database`.*
TO
    '$username'@'$host'
IDENTIFIED BY
    '$password'
SQL;
        
        #echo $statement;
        
        mysql_query($statement, $dbh);
    }
}
?>
