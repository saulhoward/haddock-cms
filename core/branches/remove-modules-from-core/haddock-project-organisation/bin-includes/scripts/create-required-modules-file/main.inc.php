<?php
/**
 * The main .INC for the create-required-modules-file script.
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

/*
 * Create the singleton objects.
 */
$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

/*
 * Get the plug-ins folder.
 */
$pd = $pdf->get_project_directory_for_this_project();

$plug_ins_dir = $pd->get_plug_in_modules_directory();

/*
 * Get the plug-ins file for the project.
 */
$psd = $pd->get_project_specific_directory();

if (!$psd->has_required_modules_file()) {
    $psd->create_required_modules_file();
}

$required_modules_file = $psd->get_required_modules_file();

/*
 * Empty the file.
 */
$required_modules_file->empty_required_modules();

/*
 * Foreach plug-in in the plug-ins folder, add an entry to
 * the file.
 */
foreach ($plug_ins_dir->get_module_directories() as $plug_in_dir) {
    $required_modules_file->add_module_directory($plug_in_dir);
}

/*
 * Write the file to disk.
 */
$required_modules_file->commit();
?>
