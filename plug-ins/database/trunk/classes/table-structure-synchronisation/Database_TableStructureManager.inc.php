<?php
/**
 * Database_TableStructureManager
 *
 * @copyright Clear Line Web Design, 2007-02-01
 */

class
    Database_TableStructureManager
{
    private $project_directory;
    
    public function
        __construct(
            HaddockProjectOrganisation_ProjectDirectory $project_directory
        )
    {
        $this->project_directory = $project_directory;
    }
    
    public function
        get_project_directory()
    {
        return $this->project_directory;
    }
    
    public function
        database_and_files_match()
    {
        $project_directory = $this->get_project_directory();
        
        /*
         * Get the tables from the database.
         */
        $mysql_user = $project_directory->get_mysql_user();
        
        $database = $mysql_user->get_database();
        
        $tables_in_db = $database->get_tables();
        
        /*
         * Get the tables from the files.
         */
        $table_specification_files
            = $project_directory->get_table_specification_files();
        
        /*
         * Compare at the table level.
         */
        
    }
    
    public function
        synchronise_database_with_files()
    {
        
    }
    
    public function
        synchronise_files_with_database()
    {
        
    }
    
    public function
        get_names_of_tables_in_db_but_not_in_files()
    {
        $names_of_tables_in_db_but_not_in_files = array();
        
        $project_directory = $this->get_project_directory();
        
        /*
         * Get the tables from the database.
         */
        $mysql_user = $project_directory->get_mysql_user();
        
        $database = $mysql_user->get_database();
        
        $names_of_tables_in_db = $database->get_table_names();
        
        /*
         * Get the tables from the files.
         */
        $names_of_tables_in_files
            = $project_directory->get_names_of_tables_in_files();
        
        foreach ($names_of_tables_in_db as $name_of_table_in_db) {
            if (
                !in_array(
                    $name_of_table_in_db,
                    $names_of_tables_in_files
                )
            ) {
                $names_of_tables_in_db_but_not_in_files[]
                    = $name_of_table_in_db;
            }
        }
        
        return $names_of_tables_in_db_but_not_in_files;
    }
    
    public function
        create_file_for_table_name(
            $table_name,
            HaddockProjectOrganisation_ModuleDirectory $module_directory
        )
    {
        $project_directory = $this->get_project_directory();
        
        $mysql_user = $project_directory->get_mysql_user();
        
        $database = $mysql_user->get_database();
        
        $table = $database->get_table($table_name);
        
        $this->create_file_for_table($table, $module_directory);
    }
    
    public function
        create_file_for_table(
            Database_Table $table,
            HaddockProjectOrganisation_ModuleDirectory $module_directory
        )
    {
        if (!$module_directory->has_table_specification_directory()) {
            $module_directory->create_table_specification_directory();
        }
        
        $table_specification_directory
            = $module_directory->get_table_specification_directory();
        
        if ($table_specification_directory->has_file_for_table($table)) {
            $table_name = $table->get_name();
            $table_specification_directory_name
                = $table_specification_directory->get_name();
            
            $msg = <<<SQL
There is already a table specification file for $table_name
in $table_specification_directory_name!
Unable to create another!
SQL;

            throw new Exception($msg);
        }
        
        $table_specification_directory->create_file_for_table($table);
        
        $table_specification_file
            = $table_specification_directory->get_file_for_table($table);
        
        $table_specification_file->save_table_structure($table);
    }
}
?>
