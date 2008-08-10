<?php
/**
 * Send people to the right place.
 *
 * @copyright RFI 2008-02-24
 */

$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$config_manager = $cmf->get_config_manager('haddock', 'public-html');

#PublicHTML_RedirectionHelper::redirect_to_absolute_location('/db-pages/home.html');

PublicHTML_RedirectionHelper::redirect_to_absolute_location($config_manager->get_default_url());
?>