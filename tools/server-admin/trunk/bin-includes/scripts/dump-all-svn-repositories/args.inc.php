<?php
/**
 * The args for the SVN repos dump script.
 *
 * @copyright Clear Line Web Design, 2007-02-09
 */

if (isset($args['repos-dir'])) {
    $repositories_directory_name = $args['repos-dir'];
} else {
    echo "Please give me the directory containing the repositories: \n";
    $repositories_directory_name = trim(fgets(STDIN));
}

if (!$silent) {
    echo "Repositories directory: $repositories_directory_name\n";
}

if (isset($args['dump-dir'])) {
    $dump_directory_name = $args['dump-dir'];
} else {
    echo "Please give me the dump directory: \n";
    $dump_directory_name = trim(fgets(STDIN));
}

if (!$silent) {
    echo "Dump directory: $dump_directory_name\n";
}

?>
