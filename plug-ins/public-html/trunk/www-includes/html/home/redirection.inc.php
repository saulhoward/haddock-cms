<?php
/**
 * Send people to the right place.
 *
 * @copyright RFI 2008-02-24
 */

#$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
#$config_manager = $cmf->get_config_manager('haddock', 'public-html');
#
##PublicHTML_RedirectionHelper::redirect_to_absolute_location('/db-pages/home.html');
#
#PublicHTML_RedirectionHelper::redirect_to_absolute_location($config_manager->get_default_url());

/*
 * Find the default location and redirect there.
 */
$default_location = PublicHTML_DefaultLocationHelper::get_default_location();

if (DEBUG) {
	echo DEBUG_DELIM_OPEN;
	
	echo 'File: ' . __FILE__ . PHP_EOL;
	echo 'Line: ' . __LINE__ . PHP_EOL;
	
	echo '$default_location: ' . $default_location . PHP_EOL;
	
	echo DEBUG_DELIM_CLOSE;
}

PublicHTML_RedirectionHelper::redirect_to_absolute_location($default_location);
?>
