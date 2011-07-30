<?php
/**
 * The Index Page.
 *
 * All requests for haddock pages are rendered by
 * this page.
 *
 * @copyright 2007-01-03, RFI
 */

/*
 * Define constants that are used throughout
 * the project.
 */
define('PROJECT_ROOT', realpath($_SERVER['DOCUMENT_ROOT']));

require_once PROJECT_ROOT
	. '/haddock/code-analysis/includes/'
	. 'define-debug-constants.inc.php';

if (DEBUG) {
	header('Content-Type: text/plain');
	
	echo DEBUG_DELIM_OPEN;
	
	echo 'File: ' . __FILE__ . PHP_EOL;
	echo 'Line: ' . __LINE__ . PHP_EOL;
	
	echo 'In DEBUG mode.' . PHP_EOL;
	
	echo DEBUG_DELIM_CLOSE;
}

if (DEBUG) {
	echo DEBUG_DELIM_OPEN;
	
	echo 'print_r($_GET)' . PHP_EOL;
	print_r($_GET);
	echo 'print_r($_POST)' . PHP_EOL;
	print_r($_POST);
	echo 'print_r($_SERVER);' . PHP_EOL;
	print_r($_SERVER);
	echo 'print_r($_SESSION);' . PHP_EOL;
	print_r($_SESSION);
	echo 'print_r($_COOKIE);' . PHP_EOL;
	print_r($_COOKIE);
	echo 'print_r($_ENV);' . PHP_EOL;
	print_r($_ENV);
	echo 'print_r($_FILES);' . PHP_EOL;
	print_r($_FILES);
	echo 'print_r($_REQUEST);' . PHP_EOL;
	print_r($_REQUEST);
	
	echo DEBUG_DELIM_CLOSE;
}

require PROJECT_ROOT
	. '/haddock/haddock-project-organisation/includes/'
	. 'autoload.inc.php';

/*
 * Output buffering so that we can throw an exception
 * anywhere in the code and still redirect to the error
 * page.
 *
 * It also looks neater.
 */
ob_start();

if (isset($_GET['oo-page'])) {
	try {		
		if (isset($_GET['page-class'])) {
			$pcrc = new ReflectionClass($_GET['page-class']);
			$pcro = $pcrc->newInstance();
		} elseif (isset($_GET['pcro-factory'])) {
			/*
			 * We want to make our page class reflection object using
			 * a Page Class Reflection Object factory.
			 *
			 * Blimy!
			 */
			
			$pcrofc = new ReflectionClass($_GET['pcro-factory']);
			
			$pcrof = $pcrofc->newInstance();
			
			$pcro = $pcrof->get_page_class_reflection_object();
		} else {
			/*
			 * Find the default location and redirect there.
			 */
			$default_location = PublicHTML_DefaultLocationHelper::get_default_location();
			
			PublicHTML_RedirectionHelper::redirect_to_absolute_location($default_location);
		}
		
		$pcro->run();
	} catch (Exception $e) {
		$exception_page_url
			= PublicHTML_ExceptionHelper
				::set_session_and_get_exception_page_url($e);
	
                header('Location: ' . $exception_page_url->get_as_string());
		exit;
	}
} else {
	/*
	 * The "old-fashioned" way.
	 *
	 * It turns out that writing .INC files and relying on the
	 * page manager to find them is incredibly difficult.
	 *
	 * My recommendation would be not to write any new code that
	 * gets called from here and use the OO pages instead.
	 *
	 * This probably won't be removed for quite a while, however.
	 */
	if (DEBUG) {
		echo DEBUG_DELIM_OPEN;
		
		echo 'File: ' . __FILE__ . PHP_EOL;
		echo 'Line: ' . __LINE__ . PHP_EOL;
		
		echo 'Rendering the page using PublicHTML_PageManager.' . PHP_EOL;
		
		echo DEBUG_DELIM_CLOSE;
	}

	$page_manager = PublicHTML_PageManager::get_instance();
	
	$page_manager->set_section(
		isset($_GET['section'])
			? $_GET['section'] : NULL
	);
	
	if ($page_manager->get_section() != 'project-specific') {
		$page_manager->set_module(
			isset($_GET['module'])
				? $_GET['module'] : NULL
		);
	}
	
	$page_manager->set_page(
		isset($_GET['page'])
			? $_GET['page'] : NULL
	);
	
	$page_manager->set_type(
		isset($_GET['type'])
			? $_GET['type'] : NULL
	);
	
	if (DEBUG) {
		echo DEBUG_DELIM_OPEN;
		
		echo 'File: ' . __FILE__ . PHP_EOL;
		echo 'Line: ' . __LINE__ . PHP_EOL;
		
		print_r($page_manager);
		
		echo DEBUG_DELIM_CLOSE;
	}
	
	if (!$page_manager->is_page()) {
		$page_manager->set_section('plug-ins');
		$page_manager->set_module('public-html');
		$page_manager->set_page('page-not-found');
		$page_manager->set_type('html');
	}
	
	$page_manager->render_inc_file('complete-page');
}

ob_end_flush();
?>