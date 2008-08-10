The Table Structure Synchronisation Script

© Clear Line Web Design, 2007-02-02

<?php
require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$table_structure_manager
    = $project_directory->get_table_structure_manager();

if ($table_structure_manager->database_and_files_match()) {
    echo "The database and the table specification files match!\n";
} else {
    echo "The database and the table specification files don't match!\n";
    
    /*
     * Recommend that the current db be backed up.
     */
?>

You should probably make a back-up of the database
before you go any further.

<?php
/*
 * First let's see if we need to make files for all the
 * tables in the database.
 */

    $names_of_tables_in_db_but_not_in_files
        = $table_structure_manager
            ->get_names_of_tables_in_db_but_not_in_files();
    
    if (count($names_of_tables_in_db_but_not_in_files) > 0) {
        echo 'There are '
            . count($names_of_tables_in_db_but_not_in_files)
            . " tables in the database that are not in the files:\n\n";
        
        for (
            $i = 0;
            $i < count($names_of_tables_in_db_but_not_in_files);
            $i++
        ) {
            echo "$i) ";
            echo $names_of_tables_in_db_but_not_in_files[$i];
            echo "\n";
        }
        echo "\n";
        
        $got_user_input = FALSE;
        while (!$got_user_input) {
            echo "Type the numbers of the tables for which to create files.\n";
            echo "Type \"A\" to create files for all the tables.\n";
            echo "Type \"S\" to skip creating files for the tables.\n";            
            
            $user_input = trim(fgets(STDIN));
            
            #echo "\$user_input: $user_input\n";
            
            $names_of_tables_to_create = array();
            
            if (preg_match('/^\d+(?:\s+\d+)*$/', $user_input, $matches)) {
                $indexes = preg_split('/\s+/', $user_input);
                foreach ($indexes as $index) {
                    
                    if (
                        ($index >= 0)
                        and
                        (
                            $index
                            <
                            count($names_of_tables_in_db_but_not_in_files)
                        )
                    ) {
                        $names_of_tables_to_create[]
                            = $names_of_tables_in_db_but_not_in_files[$index];
                    } else {
                        echo "$index is out of range!\n";
                        continue 2;
                    }
                }
                
                $got_user_input = TRUE;
            } else if (strtolower($user_input) == 'a'){
                $names_of_tables_to_create
                        = $names_of_tables_in_db_but_not_in_files;
                
                $got_user_input = TRUE;
            } else if (strtolower($user_input) == 's'){
                $got_user_input = TRUE;
            }
        }
        
        foreach ($names_of_tables_to_create as $name_of_table_to_create) {
            echo 'About to create the file for the ';
            echo "\"$name_of_table_to_create\"";
            echo " table.\n";
            
            echo "In which module directory should the files be saved?\n\n";
            
            $module_directories = $project_directory->get_module_directories();
            
            for (
                $i = 0;
                $i < count($module_directories);
                $i++
            ) {
                echo "$i) ";
                echo $module_directories[$i]->get_title();
                echo "\n";
            }
            
            echo "\n";
            
            $got_user_input = FALSE;
            while (!$got_user_input) {
                echo "Type the number of the module in which to save the file.\n";
                echo "Type \"S\" to skip to the next table.\n";            
                
                $user_input = trim(fgets(STDIN));
                
                #echo "\$user_input: $user_input\n";
                
                $module_directory = null;
                
                if (preg_match('/^(\d+)$/', $user_input, $matches)) {
                    $index = $matches[1];
                    
                    if (
                        ($index >= 0)
                        and
                        (
                            $index
                            <
                            count($module_directories)
                        )
                    ) {
                        $module_directory
                            = $module_directories[$index];
                    } else {
                        echo "$index is out of range!\n";
                        continue 2;
                    }
                    
                    $got_user_input = TRUE;
                } else if (strtolower($user_input) == 's'){
                    $got_user_input = TRUE;
                }
            }
            
            if (isset($module_directory)) {
                echo 'Saving the structure of ' . $name_of_table_to_create;
                echo ' in the ' . $module_directory->get_title() . " module.\n";
                
                $table_structure_manager->create_file_for_table_name(
                    $name_of_table_to_create,
                    $module_directory
                );
            } else {
                echo "OK, skipping.\n";
            }
        }
    } else {
?>

There are no tables in the database that don't
have table structure specification files.

<?php
    }
}
?>
