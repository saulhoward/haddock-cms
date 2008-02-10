<?php
/**
 * Work out what's being asked for on an admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

#echo 'print_r($_GET): ' . "\n";
#print_r($_GET);
#exit;

$gvm = Caching_GlobalVarManager::get_instance();

if (!isset($_GET['admin-section'])) {
    throw new Exception('The admin-section must be set for an admin includer page.');
}

#exit;

$gvm->set('admin-section', $_GET['admin-section']);

if ($gvm->get('admin-section') == 'project-specific') {
    if (isset($_GET['admin-module'])) {
        throw new Exception('admin-module set when the admin-section is \'project-specific\'!');
    }
} else {
    if (!isset($_GET['admin-module'])) {
        throw new Exception('admin-module not set when the admin-section is \'' . $gvm->get('admin-section') . '\'!');
    } else {
        $gvm->set('admin-module', $_GET['admin-module']);
    }
}

if (!isset($_GET['admin-page'])) {
    throw new Exception('The admin-page must be set for an admin includer page.');
}

$gvm->set('admin-page', $_GET['admin-page']);

//echo 'print_r($gvm): ' . "\n";
//print_r($gvm);
//exit;

///*
// * Define which module is being asked for.
// */
//define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'admin');
//
///*
// * Define which page we are on.
// */
//define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

$success_url = new HTMLTags_URL();

if (isset($_GET['success_url'])) {
	$success_url->parse_url($_GET['success_url']);
} else {
	if (isset($_GET['return_to'])) {
		$success_url->parse_url($_GET['return_to']);
	} else {
		$rm = new PublicHTML_RedirectionManager();
		$success_url = $rm->get_current_url();
		$success_url->set_get_variable('type', 'html');
	}
}

$gvm->set('success-url', $success_url);

$failure_url = new HTMLTags_URL();

if (isset($_GET['failure_url'])) {
	$failure_url->parse_url($_GET['failure_url']);
} else {
	if (isset($_GET['return_to'])) {
                $success_url->parse_url($_GET['return_to']);
        } else {
		$failure_url = clone $success_url;
	}
}

$gvm->set('failure-url', $failure_url);

#echo 'print_r($gvm): ' . "\n";
#print_r($gvm);
#exit;
?>
