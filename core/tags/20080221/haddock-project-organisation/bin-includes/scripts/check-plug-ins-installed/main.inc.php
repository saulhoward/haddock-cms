<?php
/**
 * The main .INC for the check-plug-ins-installed script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

/*
 * Create the singleton objects.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$pd = $pdf->get_project_directory_for_this_project();
$psd = $pd->get_project_specific_directory();

$plug_ins_dir = $pd->get_plug_in_modules_directory();

/*
 * Check that plug-ins listed in the project-specific directory
 * have been installed.
 */
if ($psd->has_required_modules_file()) {
    $required_modules_file = $psd->get_required_modules_file();
    
    $required_modules = $required_modules_file->get_required_modules();
    
    $installed_plug_ins = array();
    $not_installed_plug_ins = array();
    
    foreach ($required_modules as $rm) {
        if ($plug_ins_dir->has_plug_in($rm)) {
            $installed_plug_ins[] = $rm;
        } else {
            $not_installed_plug_ins[] = $rpi;
        }
    }
    
    /*
     * Show the lists.
     */
    if (count($installed_plug_ins) > 0) {
        echo "The following plug-ins have been installed:\n";
        
        foreach ($installed_plug_ins as $ipi) {
            echo "$ipi\n";
        }
        
        echo "\n";
    } else {
        echo "No installed plug-ins found.\n";
    }
    
    if (count($not_installed_plug_ins) > 0) {
        echo "The following plug-ins have not been installed:\n";
        
        foreach ($not_installed_plug_ins as $nipi) {
            echo "$nipi\n";
        }
        
        echo "\n";
    } else {
        echo "All the required plug-ins have been installed.\n";
    }
} else {
    echo "No plug-ins file found!\n";
}

/*
 * Require a user response before exiting.
 */
//echo "Press \"ENTER\" to exit.\n";
//$reply = trim(fgets(STDIN));
CLIScripts_InputReader::confirm_continue('exit');
?>
