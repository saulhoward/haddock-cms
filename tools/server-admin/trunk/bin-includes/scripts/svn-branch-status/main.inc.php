<?php
/**
 * The main section of the svn branching inspection script.
 *
 * @copyright Clear Line Web Design, 2007-04-26
 */

/*
 * Define the necessary classes.
 */

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_ProjectRootSVNWorkingDirectory.inc.php';

/*
 * Make an object for the project root.
 */

$project_root
    = new ServerAdminScripts_ProjectRootSVNWorkingDirectory(
        $project_root_dir_name
    );

/*
 * Update it.
 *
 * There shouldn't be any risk of conflicts as this
 * WD is only for inspection and organisational
 * purposes.
 */
$project_root->update($silent = FALSE);

/*
 * Is there a trunk folder?
 */
echo "----------------------------------------\n";

if ($project_root->has_trunk_directory()) {
    echo "Trunk directory found.\n";
    
    $trunk_directory = $project_root->get_trunk_directory();
    
    /*
     * What was the last changed revision of the trunk?
     */
    echo "last changed revision:\t";
    
    echo $trunk_directory->get_last_changed_revision();
    echo "\n";
    
    /*
     * Put the trunk's log messages into the history array.
     */
    $log_array = $trunk_directory->get_svn_log_array();
    
    #print_r($log_array);
    #exit;
    
    $project_root->add_log_array($log_array, 'trunk');
} else {
    echo "No trunk directory found!\n";
}

echo "----------------------------------------\n";

/*
 * Is there a folder for branches?
 */
if ($project_root->has_branches_directory()) {
    echo "Branches directory found.\n\n";
    
    $branches_directory = $project_root->get_branches_directory();
    
    $branch_directories = $branches_directory->get_branch_directories();
    
    foreach ($branch_directories as $branch_directory) {
        $basename = $branch_directory->basename();
        echo "$basename\n";
        
        echo "last changed revision:\t";
        echo $branch_directory->get_last_changed_revision();
        echo "\n";
        
        echo "branched at revision:\t";
        echo $branch_directory->get_branched_at_revision();
        echo "\n";
        
        echo "\n";
        
        /*
         * Put the branch's log messages into the history array.
         */
        $log_array = $branch_directory->get_svn_log_array();
        $project_root->add_log_array($log_array, $basename);;
    }
} else {
    echo "No branches directory found!\n";
}

echo "----------------------------------------\n";

/*
 * Is there a folder for tags?
 */
if ($project_root->has_tags_directory()) {
    echo "Tags directory found.\n";
    
    $branches_directory = $project_root->get_tags_directory();
} else {
    echo "No tags directory found!\n";
}

echo "----------------------------------------\n";

/*
 * The history of this project.
 */

echo "The history of this project:\n\n";

$project_history = $project_root->get_history();

#print_r($project_history);

foreach (array_keys($project_history) as $rev) {
    echo "Revision: $rev\n";
    
    echo 'Branch: '     . $project_history[$rev]['branch'] . "\n";
    echo 'Committer: '  . $project_history[$rev]['committer'] . "\n";
    echo 'Date: '       . $project_history[$rev]['date'] . "\n";
    echo "Message: \n"  . $project_history[$rev]['message'] . "\n";
    
    echo "\n";
}

echo "----------------------------------------\n";
?>
