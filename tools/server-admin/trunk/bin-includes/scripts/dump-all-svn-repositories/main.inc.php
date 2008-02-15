<?php
/**
 * The main .INC file for the SVN repos dump script.
 *
 * @copyright Clear Line Web Design, 2007-02-09
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_SVNRepositoryDirectory.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_SVNRepositoryDumpDirectory.inc.php';
    
/*
 * Create an array of repos objects.
 */
$repositories_directory
    = new FileSystem_Directory($repositories_directory_name);

$repositories = array();

foreach ($repositories_directory->get_subdirectories() as $sub_dir) {
    $repositories[]
        = new FileSystem_SVNRepositoryDirectory(
            $sub_dir->get_name()
        );
}

if (!$silent) {
    if (count($repositories) == 0) {
        echo "No repositories found!\n";
    } else {
        echo count($repositories) . " repositories found:\n";
        
        foreach ($repositories as $repos) {
            echo $repos->basename() . "\t" . $repos->youngest() . "\n";
        }
    }
}

/*
 * Get the SVN admin program.
 */
if ($_SERVER['OS'] == 'Windows_NT') {
    $svnadmin_program = 'svnadmin.exe';
} else {
    $svnadmin_program = '/usr/bin/svnadmin';
}

foreach ($repositories as $repos) {
    /*
    * Is there a directory to dump to?
    */
   $repos_dump_directory_name
       = $dump_directory_name . '/' . $repos->basename();
   
   if (!is_dir($repos_dump_directory_name)) {
       mkdir($repos_dump_directory_name);
   }
   
   $repos_dump_directory
       = new ServerAdminScripts_SVNRepositoryDumpDirectory(
           $repos_dump_directory_name
        );
   
    for (
        $i = ($repos_dump_directory->get_most_recent_dump_number() + 1);
        $i <= $repos->youngest();
        $i++
    ) {
        $dump_command = $svnadmin_program;
        
        $dump_command .= ' dump ';
        
        $dump_command .= '"' . $repos->get_name() . '"';
        
        $dump_command .= " -r$i:$i ";
        
        $dump_command .= " --incremental ";
        
        if ($silent) {
            $dump_command .= " --quiet ";
        }
        
        $dump_command .= ' > ';
        
        $dump_command
            .= '"' . $repos_dump_directory->get_name() . '/' . $i . '.dump"';
        
        #echo "\$dump_command: $dump_command\n";
        
        system($dump_command);
    }
}
?>
