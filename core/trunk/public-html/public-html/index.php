<?php
/**
 * The Index Page.
 *
 * All requests for haddock pages are rendered by
 * this page.
 *
 * @copyright Clear Line Web Design, 2007-01-03
 */

#header('Content-Type: text/plain');
#echo 'print_r($_GET)' . "\n";
#print_r($_GET);
#echo 'print_r($_POST)' . "\n";
#print_r($_POST);
#exit;

/*
 * Define constants that are used throughout
 * the project.
 */
require_once $_SERVER['DOCUMENT_ROOT']
    . '/haddock/public-html/public-html/define-include-paths.inc.php';
    
require_once $_SERVER['DOCUMENT_ROOT']
    . '/haddock/public-html/public-html/define-debug-constants.inc.php';

//require_once PROJECT_ROOT
//    . '/haddock/public-html/classes/'
//    . 'PublicHTML_PageManager.inc.php';
//
//require_once PROJECT_ROOT
//    . '/haddock/haddock-project-organisation/classes/'
//    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
//
//$project_directory_finder
//    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
//
//$project_directory
//    = $project_directory_finder->get_project_directory_for_this_project();
//
///*
// * Does this project have an __autoload function?
// */
//$project_directory->define_autoload_inc_file();

require_once PROJECT_ROOT
    . '/project-specific/haddock-project-organisation/autoload.inc.php';

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
			 * We want to make our page class reflection object using a Page Class Reflection Object factory.
			 *
			 * Blimy!
			 */
			
			$pcrofc = new ReflectionClass($_GET['pcro-factory']);
			
			$pcrof = $pcrofc->newInstance();
			
			$pcro = $pcrof->get_page_class_reflection_object();
		} else {
			echo "No page class set!\n";
		}
	} catch (ReflectionException $re) {
		#print_r($e);
		#echo "Unable to show that page!\n";
		echo $re->getMessage();
	}
	
	try {
		$pcro->run();
	} catch (Exception $e) {
		$exception_page_url = PublicHTML_ExceptionHelper
			::set_session_and_get_exception_page_url($e);
		
		header('Location: ' . $exception_page_url->get_as_string());
		exit;
	}
} else {
    $page_manager = PublicHTML_PageManager::get_instance();
    
    //echo 'print_r($page_manager)' . "\n";
    //print_r($page_manager);
    
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
    
    //echo 'print_r($page_manager)' . "\n";
    //print_r($page_manager);
    
    //echo '$page_manager->get_section(): ' . $page_manager->get_section() . "\n";
    //
    //if ($page_manager->get_section() != 'project-specific') {
    //    echo '$page_manager->get_module(): ' . $page_manager->get_module() . "\n";
    //}
    //
    //echo '$page_manager->get_page(): ' . $page_manager->get_page() . "\n";
    //echo '$page_manager->get_type(): ' . $page_manager->get_type() . "\n";
    //exit;
    
    if ($page_manager->is_page()) {
        //echo "Page found!\n";
        //exit;
    } else {
        #echo "Page not found!\n";
        
        $page_manager->set_section('haddock');
        $page_manager->set_module('public-html');
        $page_manager->set_page('page-not-found');
        $page_manager->set_type('html');
    }
    
    //echo '$page_manager->get_section(): ' . $page_manager->get_section() . "\n";
    //
    //if ($page_manager->get_section() != 'project-specific') {
    //    echo '$page_manager->get_module(): ' . $page_manager->get_module() . "\n";
    //}
    //
    //echo '$page_manager->get_page(): ' . $page_manager->get_page() . "\n";
    //echo '$page_manager->get_type(): ' . $page_manager->get_type() . "\n";
    //exit;
    
    $page_manager->render_inc_file('complete-page');
}

ob_end_flush();
?>