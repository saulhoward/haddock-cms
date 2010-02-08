<?php
/**
 * The default complete page for a haddock project.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

//echo '__FILE__: ' . "\n";
//echo __FILE__ . "\n";
#exit;

$gvm = Caching_GlobalVarManager::get_instance();

$page_manager = PublicHTML_PageManager::get_instance();

try {
    $page_manager->render_inc_file('redirection');
    
    $page_manager->render_inc_file('set-inc-files');
    
    $page_manager->render_inc_file('session-objects');
    $page_manager->render_inc_file('sessions');
    
    //echo '$page_manager->get_filename(\'security\'): ' . "\n";
    //echo $page_manager->get_filename('security') . "\n";
    
    $page_manager->render_inc_file('security');
    
    $page_manager->render_inc_file('check-get-vars');
    
    $page_manager->render_inc_file('create-objects');
    
    $page_manager->render_inc_file('http-headers');
    
    $page_manager->render_inc_file('cache-control');
    
    $cache_manager = Caching_CacheManager::get_instance();
    
    #print_r($cache_manager);
    #echo "About the render the display inc files.\n";    
    
    if ($cache_manager->is_page_cacheable()) {
        #echo "Page is cacheable\n";
        
        if ($cache_manager->is_page_cached()) {
            $cache_manager->render_cached_content();
        } else {
            $str = $page_manager->get_inc_file_as_string('main-inc-files');
            
            echo $str;
            
            $cache_manager->save_string_in_cache($str);
        }
    } else {
        //echo "Not cacheable!\n";
        
        $page_manager->render_inc_file('main-inc-files');
    }
    
    $page_manager->render_inc_file('logging');
} catch (Exception $e) {
    $gvm->set('exception', $e);
    
    $page_manager->render_inc_file('exception-handling');
}
?>
