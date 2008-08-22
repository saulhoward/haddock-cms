<?php
/**
 * Check the GET vars of a redirect-script.
 * 
 * @copyright Clear Line Web Design, 2007-08-30
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();


$return_to = NULL;
$success_url = NULL;
$failure_url = NULL;


?>
