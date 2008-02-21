<?php
/**
 * The main section of the script to find .INC files.
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

$page_manager = PublicHTML_PageManager::get_instance();

$page_manager->set_record_inc_files(TRUE);

ob_start();
$page_manager->render_inc_file('complete-page');
ob_clean();

$inc_files = $page_manager->get_inc_files();

//echo 'print_r($inc_files): ' . "\n";
//print_r($inc_files);

$inc_dir = $page_directory->get_name() . '/' . $page_manager->get_type();

#echo "\$inc_dir: $inc_dir\n";

$set_inc_file_filename = "$inc_dir/set-inc-files.inc.php";

if (!file_exists($set_inc_file_filename)) {
    $fh = fopen($set_inc_file_filename, 'w')
        or die("Unable to open $set_inc_file_filename!");
    
    fwrite($fh, "<?php\n");
    fwrite($fh, "/**\n");
    fwrite($fh, " * Sets the .INC files.\n");
    fwrite($fh, " *\n");
    fwrite($fh, ' * @copyright ' . date('Y-m-d') . "\n");    
    fwrite($fh, " */\n");
    fwrite($fh, "\n");
    
    fwrite($fh, '$page_manager = PublicHTML_PageManager::get_instance();' . "\n");
    fwrite($fh, "\n");
    
    $elements = array_keys($inc_files);
    sort($elements);
    
    foreach ($elements as $element) {
        fwrite($fh, '$page_manager->set_inc_file(\'' . $element . '\', \'' . $inc_files[$element] . '\');' . "\n");
    }
    
    fwrite($fh, "?>\n");
    
    fclose($fh);
} else {
    die("$set_inc_file_filename already exists!\n");
}

?>
