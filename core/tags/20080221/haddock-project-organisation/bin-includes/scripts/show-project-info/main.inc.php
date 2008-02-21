<?php
/**
 * The main .INC for the show-project-info script.
 *
 * @copyright Clear Line Web Design, 2007-10-05
 */

/*
 * Create the singleton variables.
 */
#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

/*
 * Find the module config manager.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$config_manager = $cmf->get_config_manager('haddock', 'haddock-project-organisation');

/*
 * List the info.
 */
echo "Information about your installation:\n";

$vars_to_find = array();

#$vars_to_find[] = array(
#   'fmt' => 'Release major version: \'%s\'',
#   'element_names' => array(
#      'release', 
#      'version', 
#      'major'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Release minor version: \'%s\'',
#   'element_names' => array(
#      'release', 
#      'version', 
#      'minor'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Release internal version: \'%s\'',
#   'element_names' => array(
#      'release', 
#      'version', 
#      'internal'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Release status: \'%s\'',
#   'element_names' => array(
#      'release', 
#      'status'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Project name: \'%s\'',
#   'element_names' => array(
#      'project', 
#      'name'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Project copyright holder: \'%s\'',
#   'element_names' => array(
#      'project', 
#      'copyright-holder'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Server host: \'%s\'',
#   'element_names' => array(
#      'server', 
#      'host'
#   )
#);
#
#$vars_to_find[] = array(
#   'fmt' => 'Server domain: \'%s\'',
#   'element_names' => array(
#      'server', 
#      'domain'
#   )
#);

#foreach ($vars_to_find as $vtf) {
#	if ($config_manager->has_nested_config_variable($vtf['element_names'])) {
#		printf(
#			$vtf['fmt'] . "\n",
#			$config_manager->get_nested_config_variable($vtf['element_names'])
#		);
#	}
#}

/*
printf(
    'Release major version: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('release', 'version', 'major'))
);

printf(
    'Release minor version: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('release', 'version', 'minor'))
);

printf(
    'Release internal version: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('release', 'version', 'internal'))
);

printf(
    'Release status: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('release', 'status'))
);

printf(
    'Project name: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('project', 'name'))
);

printf(
    'Project copyright holder: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('project', 'copyright-holder'))
);

printf(
    'Server host: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('server', 'host'))
);

printf(
    'Server domain: \'%s\'' . "\n",
    $hpo_mod_dir->get_nested_config_variable(array('server', 'domain'))
);
*/
//printf(
//    'Server FQDN: ' . "\n",
//    $hpo_mod_dir->get_fully_qualified_domain_name()
//);


printf(
    'Release major version: \'%s\'' . "\n",
    $config_manager->get_major_release_version()
);

#CLIScripts_InputReader::confirm_continue('exit');
?>
