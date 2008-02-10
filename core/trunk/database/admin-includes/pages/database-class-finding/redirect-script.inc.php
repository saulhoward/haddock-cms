<?php
/**
 * This is where the database class names are committed
 * to file.
 *
 * @copyright Clear Line Web Design, 2006-11-22
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

session_start();

ini_set('max_excecution_time', 60);

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_PHPClassFile.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$project_specific_directory
    = $project_directory->get_project_specific_directory();

$database_class_name_file
    = $project_specific_directory->get_database_class_name_file();

# Find out what has been set.

$post_keys = array_keys($_POST);

foreach ($post_keys as $post_key) {
    if ($post_key == 'database_class') {
        $database_class_name_file->set_database_class_file(
            new FileSystem_PHPClassFile($_POST[$post_key])
        );
    }

    if ($post_key == 'database_renderer') {
        $database_class_name_file->set_database_renderer_class_file(
            new FileSystem_PHPClassFile($_POST[$post_key])
        );
    }
    
    if (preg_match('/table-(\w+)-(\w+)/', $post_key, $matches)) {
        if ($matches[2] == 'class') {
            $database_class_name_file->set_table_class_file(
                $matches[1],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
        
        if ($matches[2] == 'renderer') {
            $database_class_name_file->set_table_renderer_class_file(
                $matches[1],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
    }

    if (preg_match('/row-(\w+)-(\w+)/', $post_key, $matches)) {
        if ($matches[2] == 'class') {
            $database_class_name_file->set_row_class_file(
                $matches[1],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
        
        if ($matches[2] == 'renderer') {
            $database_class_name_file->set_row_renderer_class_file(
                $matches[1],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
    }

    if (preg_match('/field-(\w+)-(\w+)-(\w+)/', $post_key, $matches)) {
        if ($matches[3] == 'class') {
            $database_class_name_file->set_field_class_file(
                $matches[1],
                $matches[2],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
        
        if ($matches[3] == 'renderer') {
            $database_class_name_file->set_field_renderer_class_file(
                $matches[1],
                $matches[2],
                new FileSystem_PHPClassFile($_POST[$post_key])
            );
        }
    }
}

#print_r($database_class_name_file);

$database_class_name_file->commit();

session_destroy();
?>
