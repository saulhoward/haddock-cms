<?php
/**
 * The main .INC for the check-plug-in-dependencies script.
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

/*
 * Create the singleton objects.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

/*
 * Get the plug-ins directory for the project.
 */
$pd = $pdf->get_project_directory_for_this_project();

$plug_ins_dir = $pd->get_plug_in_modules_directory();

/*
 * For each non-abstract plug-in, check their dependencies.
 */
$all_dependencies_met = TRUE;

foreach (
    $plug_ins_dir->get_plug_in_module_directories($abstract = FALSE)
    as
    $non_abstract_p_i_m_d
) {
    printf(
        "Checking the dependencies of the '%s' plug-in ...\n",
        $non_abstract_p_i_m_d->get_identifying_name()
    );
    
    $required_plug_in_module_names
        = $non_abstract_p_i_m_d->get_required_plug_in_module_names();
    
    if (count($required_plug_in_module_names) > 0) {
        //echo 'print_r($required_plug_in_module_names): '. "\n";
        //print_r($required_plug_in_module_names);
        
        echo "\n";
        echo 'The following plug-in modules are required: ';
        echo "\n\n";
        
        foreach ($required_plug_in_module_names as $r_p_i_m_n) {
            echo "\t$r_p_i_m_n\n";
        }
        
        echo "\n";
        
        if ($non_abstract_p_i_m_d->check_plug_in_module_dependencies()) {
            echo "All required plug-ins installed\n";
        } else {
            $all_dependencies_met = FALSE;
            
            echo "The following plug-ins are missing:\n";
            
            foreach ($non_abstract_p_i_m_d->get_missing_plug_in_module_names() as $m_p_i_m_n) {
                echo "$m_p_i_m_n\n";
            }
        }
    } else {
        echo "No required plug-ins.\n";
    }
    
    echo "\n";
}

if ($all_dependencies_met) {
    printf(
        "All plug-in modules in '%s' have all their dependencies met.\n",
        $plug_ins_dir->get_name()
    );
} else {
    fwrite(
        STDERR,
        sprintf(
            "Some plug-in modules in '%s' have missing required plug-in modules!\n",
            $plug_ins_dir->get_name()
        )
    );    
}

/*
 * Confirm exit from the user.
 */
CLIScripts_InputReader::confirm_continue('exit');
?>
