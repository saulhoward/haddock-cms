<?php
/**
 * The args for the create-new-database-element-subclass script.
 *
 * @copyright Clear Line Web Design, 2007-08-26
 */

/*
 * Create the Singleton objects.
 */
$muf = Database_MySQLUserFactory::get_instance();
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

/*
 * Create the database objects.
 */
$mu = $muf->get_for_this_project();
$database = $mu->get_database();

$pd = $pdf->get_project_directory_for_this_project();

/*
 * Get the args.
 */
$section_and_module
    = HaddockProjectOrganisation_CLIModuleDirectoryFinder
        ::find_section_and_module(
            $args,
            'class-section',
            "In which section do you want to save the new class?\n",
            'class-module',
            "In which module do you want to save the new class?\n"
        );

$class_section = $section_and_module['section'];

$class_module = NULL;
if (isset($section_and_module['module'])) {
    $class_module = $section_and_module['module'];
}

if (isset($args['type'])) {
    $type = $args['type'];
} else {
    $type = CLIScripts_InputReader::get_choice_from_string('element renderer');
}

if (isset($args['entity'])) {
    $entity = $args['entity'];
} else {
    $entity = CLIScripts_InputReader::get_choice_from_string('database table row field');
}

if ($entity == 'database') {
    if (isset($args['table'])) {
        throw new Exception('The table must not be set if the entity is \'database\'!');
    }
} else {
    if (isset($args['table'])) {
        $table = $args['table'];
    } else {
        //$possible_table_name = '';
        //
        //if ($class_section == 'project-specific') {
        //    $possible_table_name .= 'ps_';
        //} else {
        //    if ($class_section == 'haddock') {
        //        $possible_table_name .= 'hc_';
        //    } else if ($class_section == 'plug-ins') {
        //        $possible_table_name .= 'hpi_';
        //    }
        //    
        //    $possible_table_name .= $class_module . '_';
        //}
        
        $tables = $database->get_tables();
        
        $tables_str = '';
        
        $first = TRUE;
        foreach ($tables as $table_obj) {
            if ($first) {
                $first = FALSE;
            } else {
                $tables_str .= ' ';
            }
            
            $tables_str .= $table_obj->get_name();
        }
        
        echo "Which table?\n";
        $table = CLIScripts_InputReader::get_choice_from_string($tables_str);
        
        if (!isset($table)) {
            echo "Quitting!\n";
            exit;
        }
    }
}

if ($entity == 'field') {
    if (isset($args['field'])) {
        $field = $args['field'];
    } else {
        $table_obj = $database->get_table($table);
        
        $fields_str = '';
        
        $first = TRUE;
        foreach ($table_obj->get_fields() as $field_obj) {
            if ($first) {
                $first = FALSE;
            } else {
                $fields_str .= ' ';
            }
            
            $fields_str .= $field_obj->get_name();
        }
        
        echo "Which field?\n";
        $field = CLIScripts_InputReader::get_choice_from_string($fields_str);
        
        if (!isset($field)) {
            echo "Quitting!\n";
            exit;
        }
    }
} else {
    if (isset($args['field'])) {
        throw new Exception('The field must not be set if the entity is \'field\'!');
    }
}

if (isset($args['class-name'])) {
    $class_name = $args['class-name'];
} else {
    $class_name = '';
    
    if ($class_section == 'project-specific') {
        $module_directory = $pd->get_project_specific_directory();
        
        $class_name .= $module_directory->get_camel_case_root();
        
        if (preg_match('/^ps_(\w+)/', $table, $matches)) {
            $short_table_name = $matches[1];
        }
    } else {
        if ($class_section == 'haddock') {
            $module_directory = $pd->get_core_module_directory($class_module);
            
            $class_name .= $module_directory->get_camel_case_root();
            
            if (preg_match('/^hc_(\w+)/', $table, $matches)) {
                $short_table_name = $matches[1];
            }
        } else if ($class_section == 'plug-ins') {
            $module_directory = $pd->get_plug_in_module_directory($class_module);
            
            $class_name .= $module_directory->get_camel_case_root();
            
            if (preg_match('/^hpi_(\w+)/', $table, $matches)) {
                $short_table_name = $matches[1];
            }
        }
        
        $table_module_name = $class_module;
        
        if (preg_match('/^' . $table_module_name . '_(\w+)/', $short_table_name, $matches)) {
            //echo 'print_r($matches): ' . "\n";
            //print_r($matches);
            
            $short_table_name = $matches[1];
        //} else {
        //    echo "No match!\n";
        }
    }
    
    $class_name .= '_';
    
    $stn_low = Formatting_ListOfWords::get_list_of_words_for_string($short_table_name, '_');
    
    //echo 'print_r($stn_low): ' . "\n";
    //print_r($stn_low);
    
    $class_name .= $stn_low->get_words_as_camel_case_string();
    
    switch ($entity) {
        case 'table':
            $class_name .= 'Table';
            break;
    }
    
    echo "Class name: $class_name\n";
    
    echo "Is this class name acceptable?\n";
    
    $class_name_acceptable = CLIScripts_InputReader::ask_yes_no_question();
    
    if (!$class_name_acceptable) {
        echo "Please type the name of the class:\n";
        $class_name = trim(fgets(STDIN));
    }
}

if (isset($args['class-filename'])) {
    $class_filename = $args['class-filename'];
} else {
    $class_filename = '';
    
    if (!$module_directory->has_classes_directory()) {
        $module_directory->create_classes_directory();
    }
    
    $classes_directory = $module_directory->get_classes_directory();
    
    $class_filename = $classes_directory->get_filename_for_db_class($entity, $type, $class_name);
}

if (!$silent) {
    echo "Section: $class_section\n";
    
    if (isset($class_module)) {
        echo "Module: $class_module\n";
    }
    
    echo "Type: $type\n";
    
    echo "Entity: $entity\n";
    
    if (isset($table)) {
        echo "Table: $table\n";
    }
    
    if (isset($field)) {
        echo "Field: $field\n";
    }
    
    echo "Class name: $class_name\n";
    
    echo "Class filename: $class_filename\n";
}
?>
