<?php
/**
 * The arguments to the dump filename
 * incrementing script.
 *
 * @copyright Clear Line Web Design, 2007-02-08
 */

if (isset($args['directory'])) {
    $directory_name = $args['directory'];
} else {
    echo "Please give me the directory: \n";
    $directory_name = trim(fgets(STDIN));
}

if (!$silent) {
    echo "The directory: \n";
    echo "$directory_name\n";
}

if (isset($args['max-copies'])) {
    $max_copies = $args['max-copies'];
} else {
    $max_copies = 3;
}

if (!$silent) {
    echo "The maximum number of copies: \n";
    echo "$max_copies\n";
}

?>
