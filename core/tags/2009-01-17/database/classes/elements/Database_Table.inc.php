<?php
/**
 * Database_Table
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/**
 * A class to represent a table in a database.
 */
class
    Database_Table
extends
    Database_Element
{
    ###########
    # Members #
    ###########

    /**
     * A reference to a Database instance.
     */
    private $database;

    /**
     * The name of this table, a string.
     */
    private $name;

    /**
     * The Database_Field objects of this table.
     */
    private $fields;

    /**
     * Stats on the table.
     */
    private $stats;

    ###################
    # The constructor #
    ###################

    public function
        __construct($database, $name)
    {
        $this->database = $database;
        $this->name = $name;
    }

    ##########################
    # Accessors and Mutators #
    ##########################

    public function
        get_database()
    {
        return $this->database;
    }

    public function
        get_database_handle()
    {
        $database = $this->get_database();

        return $database->get_database_handle();
    }

    public function
        get_name()
    {
        return $this->name;
    }

    #############################
    # Find info about the table #
    #############################

    /**
     * Returns an array of Field objects,
     * one for each column in the table.
     *
     * Should this function be static?
     * see the extension of this method in
     * Database_ForeighnKeyTable
     * that would almost certainly be broken if this
     * were static.
     *
     * It works, so why fix it?
     */
    public function
        get_fields()
    {
        if (!isset($this->fields)) {
            $dbh = $this->get_database_handle();

            $query = 'SHOW COLUMNS FROM ' . $this->get_name();

            #echo $query;

            $result = mysql_query($query, $dbh);

            $this->fields = array();

            $table_name = $this->get_name();

            $database_class_factory
                = Database_DatabaseClassFactory::get_instance();

            while ($row = mysql_fetch_assoc($result)) {
                $field_class
                    = $database_class_factory
                        ->get_field_class($table_name, $row['Field']);
                        
                $this->fields[]
                    = $field_class->newInstance(
                            $this,
                            $row['Field'],
                            $row['Type'],
                            $row['Null'],
                            $row['Key'],
                            $row['Default'],
                            $row['Extra']
                        );
            }
        }

        return $this->fields;
    }

    public function
        has_field($field_name)
    {
        #echo "\$field_name: $field_name\n";

        $fields = $this->get_fields();

        #foreach ($fields as $field) {
        #    echo 'gettype($field): ' . gettype($field) . "\n";
        #
        #    if (is_object($field)) {
        #        echo 'get_class($field): ' . get_class($field) . "\n";
        #    }
        #}

        foreach ($fields as $field) {
            $possible_field_name = $field->get_name();
            #echo "\$possible_field_name: $possible_field_name\n";

            if ($possible_field_name == $field_name) {
                return TRUE;
            }
        }

        #echo "Returning false!\n";

        return FALSE;
    }

    public function
        get_field($field_name)
    {
        $fields = $this->get_fields();

        foreach ($fields as $field) {
            if ($field->get_name() == $field_name) {
                return $field;
            }
        }

        throw new Exception(
            "No field called $field_name in " . $this->get_name()
        );
    }

    public final function
        get_renderer()
    {
        $table_name = $this->get_name();

        $database_class_factory
            = Database_DatabaseClassFactory::get_instance();

        $table_renderer_class
            = $database_class_factory
                ->get_table_renderer_class($table_name);

        $renderer = $table_renderer_class->newInstance($this);

        return $renderer;
    }

    /**
     * What if the row sub class hasn't been
     * implemented yet?
     *
     * This function should just return the Row
     * class in that case.
     */
    public final function
        get_row_class()
    {
        $table_name = $this->get_name();

        $database_class_factory
            = Database_DatabaseClassFactory::get_instance();

        $row_class = $database_class_factory->get_row_class($table_name);

        return $row_class;
    }

    #############################
    # Fetch rows from the table #
    #############################

    public function
        get_rows_for_select($query)
    {
        if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\n";
			
			echo "\$query: \n$query\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
        
        $dbh = $this->get_database_handle();

        if (is_a($query, 'Database_SQLSelectQuery')) {
            $query = $query->get_as_string();
        }

		#echo '$query: ' . $query . "\n";
		#exit;

        $result = mysql_query($query, $dbh);

        $rows = array();

        $row_class = $this->get_row_class();

        while ($row = mysql_fetch_assoc($result)) {
            #print_r($row);

            $rows[] = $row_class->newInstance($this, $row);
        }

        return $rows;
    }

    protected function
        get_select_clause()
    {
        return 'SELECT * ';
    }

    protected function
        get_from_clause()
    {
        return ' FROM ' . $this->get_name() . ' ';
    }

    protected function
        get_order_by_clause($order_by, $sort_direction)
    {
        return " ORDER BY $order_by $sort_direction ";
    }

    public function
        get_rows_where(
            $conditions,
            $order_by = 'id',
            $sort_direction = 'ASC',
            $offset = 0,
            $limit = 0
        )
    {
        #print_r($conditions);

        #$query = 'SELECT * FROM ' . $this->get_name();
        $query = $this->get_select_clause();
        $query .= $this->get_from_clause();

        if (isset($conditions)) {
            #echo 'print_r($conditions): ' . "\n";
            #print_r($conditions);

            #$query .= self::condtions_to_where_clause($conditions);
            $query .= $this->condtions_to_where_clause($conditions);
        } else {
            #echo "\$conditions not given.\n";
        }

        #$query .= " ORDER BY $order_by $sort_direction";
        $query .= $this->get_order_by_clause($order_by, $sort_direction);

        if ($limit > 0) {
            $query .= " LIMIT $offset, $limit";
        }

        #
        #$query = new Database_SQLSelectQuery($query_str);

        #$query = new Database_SQLSelectQuery();
        #
        #$query->add_table($this);
        #
        #if (isset($conditions)) {
        #    $query->add_conditions_to_where_clause($conditions);
        #}
        #
        #$order_by_clause = $query->get_order_by_clause();
        #
        #$order_by_clause->set_column($order_by);
        #
        #$order_by_clause->set_sort_direction($sort_direction);
        #
        #if ($limit > 0) {
        #    $limit_clause = $query->get_limit_clause();
        #
        #    $limit_clause->set_limit($limit);
        #
        #    $limit_clause->set_offset($offset);
        #}

        return $this->get_rows_for_select($query);
    }

    public function
        get_row_by_id($id)
    {
        #$conditions['id'] = $id;
        $conditions = $this->get_row_by_id_conditions_array($id);
        #$conditions = $this->get_row_by_id_conditions_array($id);

#        echo 'print_r($conditions): ' . "\n";
#        print_r($conditions);
#	exit;

        $rows = $this->get_rows_where($conditions);

        if (count($rows) == 1) {
            return $rows[0];
        } else {
            if (count($rows) > 1) {
                /*
                 * This will only happen if the table has not
                 * been configured properly.
                 */
                throw new Exception("More than one row with id: $id!");
            } else {
                throw new Database_RowNotFoundException(
                    $this->get_name(),
                    $id
                );
            }
        }
    }

    protected function
        get_row_by_id_conditions_array($id)
    {
	    $conditions = array();

	    $conditions['id'] = $id;

	    return $conditions;
    }

    public function
        get_all_rows(
            $order_by = 'id',
            $sort_direction = 'ASC',
            $offset = 0,
            $limit = 0
        )
    {
        return $this->get_rows_where(
            NULL,
            $order_by,
            $sort_direction,
            $offset,
            $limit
        );
    }


    public function
        get_random_row()
    {
        $row = null;

        if ($this->count_all_rows() > 0) {
            $max_id = $this->max_all_rows('id');

            /*
             * Loop in case one of the rows
             * has been deleted.
             */
            do {
                $rand_id = mt_rand(1, $max_id);
                #echo $rand_id;
                try {
                    $row = $this->get_row_by_id($rand_id);
                } catch (Database_RowNotFoundException $e) {
                    /*
                     * Do nothing but try again.
                     */
                }

            } while (!isset($row));
        }

        return $row;
    }

    /**
     * Tries to find the id of a row for a set of values.
     *
     * If more than one row matches the conditions,
     * an exception is thrown.
     *
     * If no rows match the conditions, then the values
     * are inserted into the table and the new id is returned.
     */
    public function
        get_id_for_super_key_with_possible_insert($conditions)
    {
        $rows = $this->get_rows_where($conditions);

        if (count($rows) == 0) {
            /*
             * Insert a new task
             */
            $values = $conditions;

            return $this->add($values);
        } elseif (count($rows) == 1) {
            /*
             * Return the ID
             */
            return $rows[0]->get_id();
        } else {
            /*
             * Throw an exception.
             */
            throw new Exception("There's more than one row with these values!");
        }
    }

    ###############
    # Table Stats #
    ###############

    public function
        purge_stats()
    {
        $this->stats = null;
    }

    /**
     * For the queries that return numbers.
     *
     * e.g.
     *  count
     *  max
     *  min
     */
    public function
        numerical_select($query)
    {

    }

    public function
        count_all_rows()
    {
        if (!isset($this->stats['count_all_rows'])) {
            $database = $this->get_database();
            $dbh = $database->get_database_handle();

            $query = 'SELECT COUNT(id) FROM ' . $this->get_name();

            $result = mysql_query($query, $dbh);

            $this->stats['count_all_rows'] = 0;

            while ($row = mysql_fetch_array($result)) {
                $this->stats['count_all_rows'] = $row[0];
            }
        }

        return $this->stats['count_all_rows'];
    }

    public function
        count_rows_where($conditions)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $query = 'SELECT COUNT(id) FROM ' . $this->get_name();

        #$query .= self::condtions_to_where_clause($conditions);
        if (isset($conditions)) {
            $query .= $this->condtions_to_where_clause($conditions);
        }

        #echo "\$query: $query\n";

        $result = mysql_query($query, $dbh);

        $count = 0;

        while ($row = mysql_fetch_array($result)) {
            $count = $row[0];
        }

        return $count;
    }

    public function
        max_all_rows($field_name)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $query = 'SELECT MAX(' . $field_name . ') FROM ' . $this->get_name();

        #echo "\$query: $query\n";

        $result = mysql_query($query, $dbh);

        $max = 0;

        while ($row = mysql_fetch_array($result)) {
            $max = $row[0];
        }

        return $max;
    }

    public function
        max_where($field_name, $conditions)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $query = 'SELECT MAX(' . $field_name . ') FROM ' . $this->get_name();

        #$query .= self::condtions_to_where_clause($conditions);
        $query .= $this->condtions_to_where_clause($conditions);

        #echo $query;

        $result = mysql_query($query, $dbh);

        $max = 0;

        while ($row = mysql_fetch_array($result)) {
            $max = $row[0];
        }

        return $max;
    }

    public function
        min_all_rows($field_name)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $query = 'SELECT MIN(' . $field_name . ') FROM ' . $this->get_name();

        #echo "\$query: $query\n";

        $result = mysql_query($query, $dbh);

        $min = 0;

        while ($row = mysql_fetch_array($result)) {
            $min = $row[0];
        }

        return $min;
    }

    public function
        min_where($field_name, $conditions)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $query = 'SELECT MIN(' . $field_name . ') FROM ' . $this->get_name();

        #$query .= self::condtions_to_where_clause($conditions);
        $query .= $this->condtions_to_where_clause($conditions);

        #echo $query;

        $result = mysql_query($query, $dbh);

        $max = 0;

        while ($row = mysql_fetch_array($result)) {
            $max = $row[0];
        }

        return $max;
    }

    #########################
    # Add rows to the table #
    #########################

    /**
     * Adds a new row to the table.
     *
     * All instances of "'" (the single quotation
     * mark) that are not escaped with a backslash
     * are replaced with "&#039;".
     *
     * @param array $values The keys (table columns) and values to add to the table.
     */
    public function
        add($values)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $statement = 'INSERT INTO ' . $this->get_name();

        #$statement .= self::values_to_set_clause($values);
        $statement .= $this->values_to_set_clause($values);

        #echo "$statement\n";
        #exit;
        
        $rv = mysql_query($statement, $dbh);

        if ($rv) {
            return mysql_insert_id($dbh);
        } else {
            throw new Database_MySQLException($dbh);
        }
    }

    ############################
    # Modify rows in the table #
    ############################

    public function
        update_where($values, $conditions)
    {
        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $statement = 'UPDATE ' . $this->get_name() . ' ';

        $statement .= $this->values_to_set_clause($values);

        if (isset($conditions)) {
            $statement .= $this->condtions_to_where_clause($conditions);
        }

        #echo "\$statement: $statement\n";

        mysql_query($statement, $dbh);
    }

    public function
        update_by_id($id, $values)
    {
#        print_r($values);
#        exit;

        $database = $this->get_database();
        $dbh = $database->get_database_handle();

        $statement = 'UPDATE ' . $this->get_name() . ' ';

        #$statement .= self::values_to_set_clause($values);
        $statement .= $this->values_to_set_clause($values);

        #$statement .= " WHERE id = $id";
        $statement .= $this->get_update_by_id_where_clause($id);

        #echo "\$statement: $statement\n";
        #exit;
        
        $rv = mysql_query($statement, $dbh);

        if ($rv) {
            return $id;
        } else {
            #if ($err = mysql_error($dbh)) {
            #    echo "$err\n";
            #} else {
            #    echo "No error!\n";
            #}
            #exit;
            
            throw new Database_MySQLException($dbh);
        }
    }

    protected function
        get_update_by_id_where_clause($id)
    {
        return " WHERE id = $id";
    }

    public function
        update_all_rows($values)
    {
        $this->update_where($values, NULL);
    }

    #public function update_all($values)
    #{
    #
    #}

    ##############################
    # Delete rows from the table #
    ##############################

    public function
        delete_where($conditions)
    {
        $mysql_user_factory = Database_MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_project();
        $dbh = $mysql_user->get_database_handle();

        $statement = 'DELETE FROM ' . $this->get_name();

        if (isset($conditions)) {
            #$statement .= self::condtions_to_where_clause($conditions);
            $statement .= $this->condtions_to_where_clause($conditions);
        }
        #echo $statement;
        $rv = mysql_query($statement, $dbh);

        if ($rv) {
            return $rv;
        } else {
            throw new Database_MySQLException($dbh);
        }
    }

    public function
        delete_by_id($id)
    {
        $conditions['id'] = $id;
        $this->delete_where($conditions);
    }

    public function
        delete_all()
    {
        #$mysql_user_factory = Database_MySQLUserFactory::get_instance();
        #$mysql_user = $mysql_user_factory->get_for_this_project();
        #$dbh = $mysql_user->get_database_handle();
        $dbh = $this->get_database_handle();

        $statement = 'TRUNCATE TABLE ' . $this->get_name();

        $rv = mysql_query($statement, $dbh);

        if ($rv) {
            return $rv;
        } else {
            throw new MySQLException($dbh);
        }
    }

    #############################
    # Clauses of SQL statements #
    #############################

    # Maybe these should be moved to a separate class.
    # SQLStatementCreator ?

    #protected static function key_value_pair_to_equals_clause($key, $value)
    #{
    #    $equals_clause = ' ';
    #
    #    $equals_clause .= $key;
    #
    #    $equals_clause .= ' = ';
    #
    #    $numerical_or_function_value = preg_match('/^(?:\d+|[A-Z_]+\(\))$/', $value);
    #
    #    #if ($numerical_or_function_value) {
    #    #    echo "$value is numerical or a function\n";
    #    #} else {
    #    #    echo "$value is not numerical or a function\n";
    #    #}
    #
    #    if (!$numerical_or_function_value) {
    #        $equals_clause .= "'";
    #    }
    #
    #    #echo "Before replacement: \"$value\"\n";
    #
    #    # We can't use str_replace because of images
    #    # and text that contains escaped "'"s
    #    #$value = str_replace("'", '&#039;', $value);
    #
    #    # We can't add slashes a second time, because of
    #    # the images and any text that already contains
    #    # escaped single quotation marks.
    #    $value = addslashes($value);
    #
    #    # Use negative lookbehind because we only want
    #    # to match a "'" that isn't preceded by
    #    # a backslash.
    #    # We would replace a ' preceded by two backslashes,
    #    # i.e. a literal backslash.
    #    #$value = preg_replace('/(?:(?<=\\\\\\\\)|(?<!\\\\))\'/', '&#039;', $value);
    #
    #    #echo "After replacement: \"$value\"\n";
    #
    #    $equals_clause .= $value;
    #
    #    if (!$numerical_or_function_value) {
    #        $equals_clause .= "'";
    #    }
    #
    #    $equals_clause .= ' ';
    #
    #    return $equals_clause;
    #}

    protected function
        condtions_to_where_clause($conditions)
    {
        $where_clause = ' ';

        $where_clause .= ' WHERE ';

        $keys = array_keys($conditions);

        for ($i = 0; $i < count($keys); $i++) {
            if ($i > 0) {
                $where_clause .= ' AND ';
            }

            #$where_clause .= self::key_value_pair_to_equals_clause($keys[$i], $conditions[$keys[$i]]);

            $field = $this->get_field($keys[$i]);

            $where_clause .= $field->get_equals_clause($conditions[$keys[$i]]);
        }

        $where_clause .= ' ';

        #echo $where_clause;

        return $where_clause;
    }

    # Takes a hash/dictionary array and returns
    # a string suitable for inclusion in an INSERT
    # or UPDATE SQL statement.
    #
    # Removes single quotation marks.
    protected function
        values_to_set_clause($values)
    {
        $set_clause = ' ';

        $set_clause = ' SET ';

        $keys = array_keys($values);

        for ($i = 0; $i < count($keys); $i++) {
            if (isset($values[$keys[$i]])) {
                $value = $values[$keys[$i]];
                
                if ($i > 0) {
                    $set_clause .= ' , ';
                }
                
                #$set_clause .= self::key_value_pair_to_assignment_clause($keys[$i], $values[$keys[$i]]);
                #$set_clause .= $this->key_value_pair_to_assignment_clause(
                #    $keys[$i],
                #    $values[$keys[$i]]
                #);
                
                $field = $this->get_field($keys[$i]);
                
                //if ($field->validate_value($value)) {
                //    $set_clause .= $field->get_assignment_clause($value);
                //}
                $set_clause .= $field->get_assignment_clause($value);
            }
        }

        $set_clause .= ' ';

        return $set_clause;
    }
    
    /**
     * If a page sets a get variable that is an ID,
     * it should be checked here before being put into a
     * query.
     */
    public static function
        clean_get_id($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("$id is not numeric!");
        }
        
        if ($id < 1) {
            throw new Exception("$id is less than 1!");
        }
        
        if (!preg_match('/^[0-9]+$/', $id)) {
            throw new Exception("$id is not an integer!");
        }
        
        /*
         * Not really necessary at this point but
         * it's better to be safe.
         */
        $dbh = DB::m();
        
        $id = mysql_real_escape_string($id, $dbh);
        
        return $id;
    }
}
?>
