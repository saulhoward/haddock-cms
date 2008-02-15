<?php
/**
 * A script to dump the contents of the MySQL
 * databases on a server to a file.
 *
 * @copyright Clear Line Web Design, 2007-02-05
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_RemoteControlCentre.inc.php';

#/*
# * Get the config data from the file.
# */
#$project_directory_factory
#    = HaddockProjectOrganisation_ProjectDirectoryFinder
#        ::get_instance();
#$project_directory =
#    $project_directory_factory->get_project_directory_for_this_project();
#
#$config_file = $project_directory->get_instance_specific_config_file();

/*
 * Get the control centre.
 */
#$control_centre
#    = new ServerAdminScripts_RemoteControlCentre(
#        $config_file->get_control_centre_url()
#    );

/*
 * Check that there aren't any previous instances
 * of this script that are still running.
 *
 * If there are, exit.
 */
#if (
#    $control_centre->count_current(
#        'dumping',
#        'mysql',
#        $project_directory->get_current_host_name()
#    )
#    >
#    0
#) {
#    /*
#     * Shouldn't an email be sent to a sys admin?
#     */
#    
#    exit;
#}

/*
 * Check that there aren't any scripts downloading the
 * dump files from this server at the moment.
 *
 * When a script starts downloading a dump file from
 * this server, it tells the control centre that
 * the machine running the script is downloading
 * and the machine with the dump files is uploading.
 */
#do {
#    $number_of_downloaders
#        = $control_centre->count_current(
#            'uploading',
#            'mysql',
#            $project_directory->get_current_host_name()
#        );
#    
#    if ($number_of_downloaders > 0) {
#        sleep($config_file->get_download_wait_seconds());
#    }
#} while ($number_of_downloaders > 0);

/*
 * Tell the central control server that we're about
 * to dump the data from the database.
 */
#$task_event_id = $control_centre->start(
#    'dumping',
#    'mysql',
#    $project_directory->get_current_host_name()
#);

#$dump_directory
#    = new ServerAdminScripts_DumpDirectory($dump_directory_name);

#$dump_directory = $config_file->get_dump_directory();

/*
 * Get the username, password and host for accessing the database.
 */
#$username = $config_file->get_mysql_username();
#$password = $config_file->get_mysql_password();
#$host = $config_file->get_mysql_host();

/*
 * Delete the oldest files.
 *
 * Minus one because we're about to dump another.
 */
#$dump_directory->delete_all_but_youngest($copies - 1);

/*
 * Rename the old files.
 */
#$dump_directory->shift_names_up();

#$previous_dump_files = array();
#foreach (glob("$dump_dir/*.dump") as $previous_dump_file) {
#    if (preg_match('/(\d+).dump$/', $previous_dump_file, $matches)) {
#        $previous_dump_files[$matches[1]] = $previous_dump_file;
#    }
#}
#
#rsort($previous_dump_files);
#
#print_r($previous_dump_files);
#
#foreach ($previous_dump_files as $previous_dump_file) {
#    if (preg_match('/(\d+).dump$/', $previous_dump_file, $matches)) {
#        
#        print_r($matches);
#        
#        if ($matches[1] > $copies) {
#            unlink ($previous_dump_file);
#        } else {
#            rename(
#                $previous_dump_file,
#                "$dump_dir/" . ($matches[1] + 1) . '.dump'
#            );
#        }
#    }
#}

/*
 * Get the list of databases for this server.
 */
$dbh = mysql_connect($host, $username, $password)
    or die("Unable to connect to the DB!\n");

$result = mysql_query("SHOW DATABASES", $dbh);

while ($row = mysql_fetch_assoc($result)) {
    /*
     * Dump the contents of the database.
     */
    
    $database = $row['Database'];
    
    $cmd = 'mysqldump'
        . " --databases $database"
        . " --user=$username"
        . " --password=$password"
        . " --host=$host"
        . " --skip-extended-insert"
        . " --order-by-primary";
    
    /*
     * Do we need to create a directory for this DB?
     */
    #$db_dump_dir = $dump_directory->get_name() . "/$database";
    $db_dump_dir = "$dump_directory_name/$database";
    
    if (!is_dir($db_dump_dir)) {
        mkdir($db_dump_dir);
    }
    
    $dump_filename = "$db_dump_dir/latest.dump";
    
    $dump_file = new FileSystem_File($dump_filename);
    #$dump_file = $dump_directory->get_next_dump_file();
    
    #if ($_SERVER['OS'] == 'Windows_NT') {
        $cmd .= ' > "' . $dump_file->get_name() . '"';
    #} else {
    #    $cmd .= " > $dump_filename";
    #}
    
    if (!$silent) {
        echo "The command: $cmd\n";
    }
    
    system($cmd);
}

/*
 * -----------------------------------------------------------------------------
 * Store this information in the database.
 * -----------------------------------------------------------------------------
 */

/*
 * Create the database objects.
 */
#$mysql_user_factory = Database_MySQLUserFactory::get_instance();
#$mysql_user = $mysql_user_factory->get_for_this_project();
#$database = $mysql_user->get_database();

/*
 * Make sure that there is a MySQL dump type.
 */
#$types_table = $database->get_table('types');
#
#$mysql_type = $types_table->get_mysql_type();

/*
 * Tell the control centre that we've finished.
 */
#$control_centre->finish($task_event_id);
?>
