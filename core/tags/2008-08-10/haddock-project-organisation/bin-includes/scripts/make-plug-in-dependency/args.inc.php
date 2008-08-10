<?php
/**
 * The args for the make-plug-in-dependency script.
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

/*
 * Create the singleton objects.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$pd = $pdf->get_project_directory_for_this_project();

$plug_ins_dir = $pd->get_plug_in_modules_directory();

if (isset($args['dependent'])) {
    $dependent_name = $args['dependent'];
    
    //if (!$plug_ins_dir->has_plug_in($args['dependent'])) {
    //    throw new ErrorHandling_SprintfException(
    //            "No plug-in called '%s' in '%s'!",
    //            array(
    //                $dependent,
    //                $plug_ins_dir->get_name()
    //            )
    //    );
    //}
} else {
    echo "Which plug-in do you want to make dependent on others?\n";
    
    $choice_str = '';
    
    $first = TRUE;
    foreach ($plug_ins_dir->get_module_directories() as $m_d) {
        if ($first) {
            $first = FALSE;
        } else {
            $choice_str .= ' ';
        }
        
        $choice_str .= $m_d->get_identifying_name();
    }
    
    $dependent_name
        = CLIScripts_InputReader
            ::get_choice_from_string(
                $choice_str
            );
    
    if (!isset($dependent_name)) {
        echo "Quitting!\n";
        exit;
    }
}

$dependent = $plug_ins_dir->get_module_directory($dependent_name);

/*
 * ----------------------------------------
 * Find out the modules that are going to be required.
 * ----------------------------------------
 */
$available_modules = array();

foreach ($plug_ins_dir->get_module_directories() as $p_i_m_d) {
    if (
        $p_i_m_d->get_identifying_name()
        !=
        $dependent->get_identifying_name()
    ) {
        $available_modules[] = $p_i_m_d;
    }
}

$required_modules = array();

while (TRUE) {
    echo "Please enter the numbers for the required modules:\n";
    
    for ($i = 0; $i < count($available_modules); $i++) {
        printf(
            "%d) %s\n",
            $i,
            $available_modules[$i]->get_identifying_name()
        );
    }
    
    echo "Type \"b\" to go back.\n";
    
    $choices_str = trim(fgets(STDIN));
    
    if (preg_match('/b/i', $choices_str)) {
        echo "Quitting!\n";
        exit;
    }
    
    if (preg_match('/^\d+(?:\s+\d+)*$/i', $choices_str)) {
        
        $numbers = preg_split('/\s+/', $choices_str);
        
        $out_of_range = FALSE;
        
        for ($i = 0; $i < count($numbers); $i++) {
            $numbers[$i] = (int)$numbers[$i];
        }
        
        foreach ($numbers as $number) {
            if (
                ($number < 0)
                ||
                ($number > count($available_modules))
            ) {
                echo "$number is out of range!\n";
                $out_of_range = TRUE;
                
                break;
            }
        }
        
        if (!$out_of_range) {
            $numbers = array_unique($numbers);
            sort($numbers);
            
            foreach ($numbers as $number) {
                $required_modules[] = $available_modules[$number];
            }
            
            break;
        }
    } else {
        echo "Please enter just integers in the given range!\n";
        continue;
    }
} 

if (!$silent) {
    printf(
        "Dependent module: %s\n",
        $dependent->get_identifying_name()
    );
    
    printf(
        "The following modules will be required by '%s'.\n",
        $dependent->get_identifying_name()
    );
    
    foreach ($required_modules as $r_m) {
        echo $r_m->get_identifying_name() . "\n";
    }
}
?>
