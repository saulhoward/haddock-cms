<?php
/**
 * The args for the svn branching inspection script.
 *
 * @copyright Clear Line Web Design, 2007-04-26
 */

if (isset($args['project-root'])) {
    $project_root_dir_name = $args['project-root'];
} else {
    echo "Please give me the project root: \n";
    $project_root_dir_name = trim(fgets(STDIN));
}

$project_root_dir_name = realpath($project_root_dir_name);

echo "The project root under inspection: \n";
echo "$project_root_dir_name\n";
?>
