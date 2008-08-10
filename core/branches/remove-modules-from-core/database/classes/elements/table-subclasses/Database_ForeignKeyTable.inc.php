<?php
/**
 * Database_ForeignKeyTable
 *
 * @copyright Clear Line Web Design, 2007-04-30
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';

abstract class
    Database_ForeignKeyTable
extends
    Database_Table
{
    protected function
        get_select_clause()
    {
        $select_clause = 'SELECT ';
        
        #$select_clause .= $this->get_name();
        
        #$select_clause .= '.* ';
        $first = TRUE;
        foreach (parent::get_fields() as $field) {
            if ($first) {
                $first = FALSE;
            } else {
                $select_clause .= ' , ';
            }
            
            $select_clause .= $this->get_name();
            $select_clause .= '.';
            $select_clause .= $field->get_name();
            
            $select_clause .= ' AS ';
            
            $select_clause .= $this->get_name();
            $select_clause .= '__';
            $select_clause .= $field->get_name();
        }
        
        $foreign_key_table_names = $this->get_foreign_key_table_names();
        $database = $this->get_database();
        
        foreach ($foreign_key_table_names as $f_k_t_n) {
            #$f_k_t_n.* ";
            
            $table = $database->get_table($f_k_t_n);
            
            foreach ($table->get_fields() as $field) {
                $select_clause .= ' , ';
                
                $select_clause .= $f_k_t_n;
                $select_clause .= '.';
                $select_clause .= $field->get_name();
                
                $select_clause .= ' AS ';
                
                $select_clause .= $f_k_t_n;
                $select_clause .= '__';
                $select_clause .= $field->get_name();
            }
        }
        
        $select_clause .= ' ';
        
        return $select_clause;
    }
    
    protected function
        get_from_clause()
    {
        $from_clause = ' FROM ';
        
        $from_clause .= $this->get_name();
        
        $foreign_key_table_names = $this->get_foreign_key_table_names();
        
        foreach (array_keys($foreign_key_table_names) as $f_k_f_n) {
            $from_clause .= ' INNER JOIN ';
            
            $from_clause .= $foreign_key_table_names[$f_k_f_n];
            
            $from_clause .= ' ON ';
            
            $from_clause .= $this->get_name() . '.' . $f_k_f_n;
            
            $from_clause .= ' = ' . $foreign_key_table_names[$f_k_f_n] . '.id ';
        }
        
        return $from_clause;
    }
    
    protected function
        get_order_by_clause(
            $order_by,
            $sort_direction,
            $table_name = NULL
        )
    {
        $order_by_clause = ' ORDER BY ';
        
        if (!isset($table_name)) {
            $table_name = $this->get_name();
        }
        
        $order_by_clause .= " $table_name.$order_by $sort_direction ";
        
        return $order_by_clause;
    }
    
    /**
     * Should return an array:
     *  $array['field_name'] = 'table_name'
     *  ...
     */
    public static abstract function
        get_foreign_key_table_names();
        
    public function
        get_fields()
    {
        $fields = parent::get_fields();
        
        /*
         * Get the foreign key table names from
         * <code>$this-></code> instead of <code>self::</code>.
         *
         * For an explanation, see
         * http://bugs.php.net/bug.php?id=30934
         *
         * This code seems to be a bit of a muddle.
         * Should <code>get_foreign_key_table_names</code> be
         * a member method?
         * The array returned is the same for all instances
         * of the class, hence I made it static to start with.
         */
        #echo 'get_class($this): ' . get_class($this) . "\n";
        #echo 'get_class(self): ' . get_class(self) . "\n";
        #$foreign_key_field_names = self::get_foreign_key_table_names();
        $foreign_key_field_names = $this->get_foreign_key_table_names();
        
        #print_r($foreign_key_field_names);
        
        $database = $this->get_database();
        
        foreach (array_keys($foreign_key_field_names) as $f_k_f_n) {
            $table = $database->get_table($foreign_key_field_names[$f_k_f_n]);
            #echo '$table->get_name(): ' . $table->get_name() . "\n";
            
            $foreign_key_table_fields = $table->get_fields();
            
            foreach ($foreign_key_table_fields as $f_k_t_f) {
                #echo 'gettype($f_k_t_f): ' . gettype($f_k_t_f) . "\n";
                
                $fields[] = $f_k_t_f;
            }
        }
        
        foreach ($fields as $field) {
            $field->set_name($field->get_table_name_dot_field_name());
        }
        
        return $fields;
    }
    
    public function
        has_field($field_name)
    {
        #echo "\$field_name: $field_name\n";
        
        $fields = $this->get_fields();
        
        if (preg_match('/^(\w+)(?:__|\.)(\w+)$/', $field_name, $matches)) {
            $table_name = $matches[1];
            #echo "\$table_name: $table_name\n";
            
            $just_field_name = $matches[2];
            #echo "\$just_field_name: $just_field_name\n";
            
            if ($table_name == $this->get_name()) {
                #echo "Field is in this table.\n";
                #echo 'get_class(parent): ' . get_class(parent) . "\n";
                
                #return parent::has_field($just_field_name);
                return parent::has_field("$table_name.$just_field_name");
            } else {
                $foreign_key_table_names = $this->get_foreign_key_table_names();
                
                $database = $this->get_database();
                
                foreach ($foreign_key_table_names as $f_k_t_n) {
                    if ($f_k_t_n == $table_name) {
                        $table = $database->get_table($table_name);
                        
                        return $table->has_field($just_field_name);
                    }
                }
            }
        } else {
            return parent::has_field($field_name);
        }
        
        return FALSE;
    }
    
    public function
        get_field($field_name)
    {
        $fields = $this->get_fields();
        
        if (preg_match('/^(\w+)(?:__|\.)(\w+)$/', $field_name, $matches)) {
            $table_name = $matches[1];
            $just_field_name = $matches[2];
            
            if ($table_name == $this->get_name()) {
                #$field = parent::get_field($just_field_name);
                
                #$field->set_name("$table_name.$just_field_name");
                
                #return $field;
                #return parent::get_field($field_name);
                
                return parent::get_field("$table_name.$just_field_name");
            } else {
                $foreign_key_table_names = $this->get_foreign_key_table_names();
                
                $database = $this->get_database();
                
                foreach ($foreign_key_table_names as $f_k_t_n) {
                    if ($f_k_t_n == $table_name) {
                        $table = $database->get_table($table_name);
                        
                        $field = $table->get_field($just_field_name);
                        
                        $field->set_name("$table_name.$just_field_name");
                        
                        return $field;
                    }
                }
            }
        } else {
            #echo "\$field_name: $field_name\n";
            #echo "Should prepend table_name?\n";
            
            return parent::get_field($field_name);
        }
        
        throw new Exception(
            "No field called $field_name in " . $this->get_name()
        );
    }
    
    #protected function
    #    get_update_by_id_where_clause($id)
    #{
    #    return ' WHERE id = ' . $this->get_name() . ".$id";
    #}
    
    protected function
        get_row_by_id_conditions_array($id)
    {
        $conditions[$this->get_name() . '.id'] = $id;
        
        return $conditions;
    }
}
?>
