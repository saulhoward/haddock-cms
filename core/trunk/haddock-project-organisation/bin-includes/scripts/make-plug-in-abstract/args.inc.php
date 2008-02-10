<?php
/**
 * The args for the make-plug-in-abstract script.
 *
 * @copyright Clear Line Web Design, 2007-09-28
 */

/*
 * Create the singleton objects.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$pd = $pdf->get_project_directory_for_this_project();

$plug_ins_dir = $pd->get_plug_in_modules_directory();

if (isset($args['plug-in'])) {
    $plug_in_name = $args['plug-in'];
} else {
    echo "Which plug-in do you want to make abstract?\n";
    
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
    
    $plug_in_name
        = CLIScripts_InputReader
            ::get_choice_from_string(
                $choice_str
            );
    
    if (!isset($plug_in_name)) {
        echo "Quitting!\n";
        exit;
    }
}

$plug_in = $plug_ins_dir->get_module_directory($plug_in_name);

if (!$silent) {
    printf(
        "Plug-in module: %s\n",
        $plug_in->get_identifying_name()
    );
}
?>
