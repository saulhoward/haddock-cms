<?php
/**
 * The main .INC for the make-plug-in-dependency script.
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

//echo '__FILE__: ' . "\n";
//echo __FILE__ . "\n";

/*
 * Get the required modules config file.
 */
if (!$dependent->has_required_modules_file()) {
    $dependent->create_required_modules_file();
}

$required_modules_file = $dependent->get_required_modules_file();

$required_modules_file->empty_required_modules();

foreach ($required_modules as $r_m) {
    $required_modules_file->add_module_directory($r_m);
}

$required_modules_file->commit();
?>
