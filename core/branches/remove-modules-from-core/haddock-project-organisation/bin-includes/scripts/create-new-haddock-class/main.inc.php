<?php
/**
 * The main .INC for the create-new-haddock-class script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

/*
 * Create the singleton objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory = $pdf->get_project_directory_for_this_project();
$cm = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

if ($class_section == 'project-specific') {
    $module_directory = $project_directory->get_project_specific_directory();
} else {
    if ($class_section == 'haddock') {
        $module_directory = $project_directory->get_core_module_directory($class_module);
    } elseif ($class_section == 'plug-ins') {
        $module_directory = $project_directory->get_plug_in_module_directory($class_module);
    }
}

$full_class_name = $module_directory->get_camel_case_root()
    . '_'
    . $class_name;

if (!$silent) {
    echo "The full class name: $full_class_name\n";
}

$classes_directory = $module_directory->get_classes_directory();

$class_filename = $classes_directory->get_name() . "/$full_class_name.inc.php";

if (!$silent) {
    echo "The class filename: $class_filename\n";
}

if (file_exists($class_filename)) {
    throw new Exception("$class_filename already exists!\n");
} else {
    /*
     * Create the file.
     */
    if ($fh = fopen($class_filename, 'w')) {
        fwrite($fh, "<?php\n");

        $date = date('Y-m-d');

        #$config_file = $project_directory->get_config_file();
        #$copyright_holder = $config_file->get_copyright_holder();

        $copyright_holder = $cm->get_copyright_holder();

        fwrite($fh, "/**\n");
        fwrite($fh, " * $full_class_name\n");
        fwrite($fh, " *\n");
        fwrite($fh, " * @copyright $copyright_holder, $date\n");
        fwrite($fh, " */\n");
        fwrite($fh, "\n");

        fwrite($fh, "class\n");
        fwrite($fh, "\t$full_class_name\n");
        fwrite($fh, "{\n");
        fwrite($fh, "}\n");

        fwrite($fh, "?>\n");

        fclose($fh);
    } else {
        throw new Exception("Unable to open $class_filename for writing!\n");
    }
}

/*
 * Refresh the autoload file.
 */
$project_directory->refresh_autoload_file();
?>
