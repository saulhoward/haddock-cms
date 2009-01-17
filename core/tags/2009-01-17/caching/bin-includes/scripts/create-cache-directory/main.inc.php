<?php
/**
 * The main include file for creating the cache directory.
 *
 * @copyright Clear Line Web Design, 2007-07-31
 */

$cache_dir_name = PROJECT_ROOT . '/cache';

///*
// * Create the directory.
// */
//if (is_dir($cache_dir_name)) {
//    if (!$silent) {
//        echo "The \"$cache_dir_name\" already exists!\n";
//    }
//} else {
//    if (!$silent) {
//        echo "Creating \"$cache_dir_name\"\n";
//    }
//    
//    mkdir($cache_dir_name);
//}
//
///*
// * Make a .htaccess file for the cache dir.
// */
//
//$htaccess_filename = $cache_dir_name . '/.htaccess';
//
//if (file_exists($htaccess_filename)) {
//    if (!$silent) {
//        echo "The \"$htaccess_filename\" already exists!\n";
//    }
//} else {
//    if (!$silent) {
//        echo "Creating \"$htaccess_filename\"\n";
//    }
//    
//    if ($fh = fopen($htaccess_filename, 'w')) {
//        $date = date('Y-m-d');
//        
//        fwrite($fh, "# File to restrict acccess to the cache dir.\n");
//        fwrite($fh, "# $date\n");
//        fwrite($fh, "\n");
//        
//        fwrite($fh, "Order Deny,Allow\n");
//        fwrite($fh, "Deny from all\n");
//        
//        fclose($fh);
//    } else {
//        throw new Exception("Unable to open \"$htaccess_filename\" for writing!\n");
//    }
//}

Caching_CacheDirectoryCreator
    ::create_cache_directory(
        $cache_dir_name,
        $restrict_access = TRUE,
        $silent
    );
?>
