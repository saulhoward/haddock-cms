<?php
/**
 * CodeAnalysis_ListClassesCLIScript
 *
 * @copyright 2008-05-30, RFI
 */

class
	CodeAnalysis_ListClassesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$batch_mode = isset($args['batch-mode']);

$whole_project = isset($args['whole-project']);

if (!$whole_project) {
    $section_and_module = HaddockProjectOrganisation_CLIModuleDirectoryFinder
        ::find_section_and_module(
            $args,
            'search-section',
            "The section to search must be set:\n",
            'search-module',
            "The module to search must be set:\n"
        );
}

if (isset($args['parent-class'])) {
    $parent_class = $args['parent-class'];
}

$output_in_csv = isset($args['csv']);
//$output_in_csv = FALSE;
//if ($batch_mode) {
//    $output_in_csv = isset($args['csv']);
//} else {
//    if (isset($args['csv'])) {
//        $output_in_csv = TRUE;
//    } else {
//        echo "Output in CSVs?\n";
//        $output_in_csv = CLIScripts_InputReader::get_choice_from_string('yes no');
//    }
//}

$methods = FALSE;
if ($batch_mode) {
    $methods = isset($args['methods']);
} else {
    if (isset($args['methods'])) {
        $methods = TRUE;
    } else {
        echo "Search for methods?\n";
        $methods = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
}

$files = FALSE;
if ($batch_mode) {
    $files = isset($args['files']);
} else {
    if (isset($args['files'])) {
        $files = TRUE;
    } else {
        echo "List the files?\n";
        $files = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
}

if ($methods) {
    $sort_methods = FALSE;
    if (isset($args['sort-methods'])) {
        $sort_methods = TRUE;
    } else {
        echo "Sort the methods?\n";
        $sort_methods = (CLIScripts_InputReader::get_choice_from_string('yes no') == 'yes');
    }
} else {
    if (isset($args['sort-methods'])) {
        throw new Exception('--sort-methods must not be set if --methods is not set!');
    }
}

if (!$silent) {
    echo $batch_mode ? "Running in batch mode.\n" : "Not running in batch mode.\n";
    
    if ($whole_project) {
        echo "Searching the whole project.\n";
    } else {
        echo 'Searching the ' . $section_and_module['section'] . " section.\n";
        
        if ($section_and_module['section'] != 'project-specific') {
            echo 'Searching the ' . $section_and_module['module'] . " module.\n";
        }
    }
    
    echo 'Output ' . ($output_in_csv ? '' : 'not ') . "in CSVs.\n";
    
    echo ($methods ? 'L' : 'Not l') . "isting the methods.\n";
    
    echo ($files ? 'L' : 'Not l') . "isting the files.\n";
}
/*
 * Find the classes.
 */
 
$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$php_class_files = array();
if ($whole_project) {
    if (isset($parent_class)) {
        $php_class_files = $project_directory->get_php_subclass_files($parent_class);
    } else {
        $php_class_files = $project_directory->get_php_class_files();
    }
} else {
    if ($section_and_module['section'] == 'project-specific') {
        $module_directory = $project_directory->get_project_specific_directory();
    } else {
        if ($section_and_module['section'] == 'haddock') {
            $module_directory = $project_directory->get_core_module_directory($section_and_module['module']);
        } elseif ($section_and_module['section'] == 'plug-ins') {
            $module_directory = $project_directory->get_plug_in_module_directory($section_and_module['module']);
        }
    }
    
    if ($parent_class) {
        $php_class_files = $module_directory->get_php_subclass_files($parent_class);
    } else {
        $php_class_files = $module_directory->get_php_class_files();
    }
}

usort($php_class_files, array('FileSystem_PHPClassFile', 'cmp_php_class_names'));

/*
 * Print off the data.
 */
if (count($php_class_files) > 0) {
    if ($methods) {
        /*
         * Does it makes sense to do this in batch mode or CSV mode?
         */
        if (!$batch_mode and !$output_in_csv) {
            echo "Which class do you want to search for methods?\n";
            
            $choice_str = '';
            
            $first = TRUE;
            foreach ($php_class_files as $p_c_f) {
                if ($first) {
                    $first = FALSE;
                } else {
                    $choice_str .= ' ';
                }
                
                $choice_str .= $p_c_f->get_php_class_name();
            }
            
            $class_name = CLIScripts_InputReader::get_choice_from_string($choice_str);
            
            $php_class_file = NULL;
            foreach ($php_class_files as $p_c_f) {
                if ($p_c_f->get_php_class_name() == $class_name) {
                    $php_class_file = $p_c_f;
                    break;
                }
            }
            
            if (isset($php_class_file)) {
                echo 'The methods of ' . $php_class_file->get_php_class_name();
                
                if ($files) {
                    echo ' saved in "PROJECT_ROOT . ' . $php_class_file->get_name_relative_to_dir(PROJECT_ROOT) . '"';
                }
                
                echo ":\n\n";
                
                $class_reflection_object = $php_class_file->get_reflection_class();
                $method_names = array();
                
                foreach ($class_reflection_object->getMethods() as $method) {
                    if ($method->getDeclaringClass() == $class_reflection_object) {
                        $method_names[] =  $method->getName();
                    }
                }
                
                if ($sort_methods) {
                    sort($method_names);
                }
                
                foreach ($method_names as $mn) {
                    echo "\t$mn\n";
                }
                
                echo "\n";
            }
        }
    } else {
        if (!$output_in_csv) {
            echo "\nThe classes: \n\n";
        }
        
        foreach ($php_class_files as $p_c_f) {
            if ($output_in_csv) {
                echo '"' . $p_c_f->get_php_class_name() . '"';
                
                if ($files) {
                    echo ',';
                    echo '"' . $p_c_f->get_name_relative_to_dir(PROJECT_ROOT) . '"';
                }
                
                echo "\n";
            } else {
                echo "\t" . $p_c_f->get_php_class_name();
                
                if ($files) {
                    echo "\n";
                    echo "\t" . $p_c_f->get_name_relative_to_dir(PROJECT_ROOT) . "\n";
                }
                
                echo "\n";
            }
        }
        
        if (!$output_in_csv) {
            echo "\n";
        }
    }
} else {
    if (!$output_in_csv) {
        echo "No classes found!\n";
    }
}
#/*
# * Require a user response before exiting.
# */
#if (!$batch_mode) {
#    echo "Press \"ENTER\" to exit.\n";
#    $reply = trim(fgets(STDIN));
#}
	}
}
?>