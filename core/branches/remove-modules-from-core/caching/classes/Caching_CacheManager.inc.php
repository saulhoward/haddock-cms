<?php
/**
 * Caching_CacheManager
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

class
    Caching_CacheManager
{
    private static $instance = NULL;
    
    private $is_page_cacheable;
    
    private $cache_filename;
    
    private function
        __construct()
    {
        $this->is_page_cacheable = FALSE;
    }
    
    public static function
        get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new Caching_CacheManager();
        }
        
        return self::$instance;
    }
    
    public function
        is_page_cacheable()
    {
        return $this->is_page_cacheable;
    }
    
    public function
        set_page_cacheability($page_cacheability)
    {
        $this->is_page_cacheable = $page_cacheability;
    }
    
    public function
        is_page_cached()
    {
        $cache_filename = $this->get_cache_filename();
        
        if (file_exists($cache_filename)) {
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function
        set_cache_filename($cache_filename)
    {
        $this->cache_filename = $cache_filename;
    }
    
    public function
        get_cache_filename()
    {
        if (!isset($this->cache_filename)) {
            $this->cache_filename = PROJECT_ROOT . '/cache/';
            
            $this->cache_filename .= md5($_SERVER['REQUEST_URI']);
            
            $this->cache_filename .= '.inc.php';
        }
        
        return $this->cache_filename;
    }
    
    public function
        save_string_in_cache($str)
    {
        $cache_filename = $this->get_cache_filename();
        
        #echo "\$cache_filename: $cache_filename\n";
        
        if ($fh = fopen($cache_filename, 'w')) {
            fwrite($fh, $str);
            
            fclose($fh);
        } else {
            throw new Exception("Unable to open cache file \"$cache_filename\" for writing!\n");
        }
    }
    
    public function
        render_cached_content()
    {
        $cache_filename = $this->get_cache_filename();
        
        require $cache_filename;
    }
}
?>
