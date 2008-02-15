<?php
/**
 * The args for the database dumping script.
 *
 * @copyright Clear Line Web Design, 2007-02-05
 */

#print_r($args); exit;

if (isset($args['username'])) {
    $username = $args['username'];
} else {
    $username = 'root';
}

if (!$silent) {
    echo "Username: $username\n";
}

if (isset($args['host'])) {
    $host = $args['host'];
} else {
    $host = 'localhost';
    #$host = trim(shell_exec('hostname'));
}

if (!$silent) {
    echo "Host: $host\n";
}

if (isset($args['password'])) {
    $password = $args['password'];
} else {
    echo "Please give me the password for $username@$host: \n";
    $password = trim(fgets(STDIN));
}

if (!$silent) {
    echo "Password: $password\n";
}

if (isset($args['dump-dir'])) {
    $dump_directory_name = $args['dump-dir'];
} else {
    echo "Please give me the directory to dump the files in: \n";
    $dump_directory_name = trim(fgets(STDIN));
}

if (is_dir($dump_directory_name)) {
    if (!$silent) {
        echo "Dump dir: $dump_directory_name\n";
    }
} else {
    die("$dump_directory_name is not a directory!\n");
}
?>
