<?php
/**
 * FileSystem_Directory
 *
 * @copyright Clear Line Web Design, 2006-11-13
 */

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_File.inc.php';

/**
 * Represents a directory in a file system.
 */
class
    FileSystem_Directory
extends
    FileSystem_File
{
    public function
        get_files(
            $order_by = NULL,
            $direction = 'ASC'
        )
    {
        #echo 'Fetching the files from ' . $this->get_name() . "\n";
        
        $files = array();
        
        foreach (glob($this->get_name() . '/*') as $file_name) {
            #echo "\$file_name: $file_name\n";
            if (is_file($file_name)) {
                #echo "$file_name is a file.\n";
                $files[] = new FileSystem_File($file_name);
            }
        }
        
        if (isset($order_by)) {
            switch ($order_by) {
                case 'name':
                    #echo "Comparing by name.\n";
                    
                    usort(
                        $files,
                        array('FileSystem_File', 'cmp_name')
                    );
                    #sort($files, 'FileSystem_File::cmp_name');
                    break;
                case 'ctime':
                    #echo "Comparing by ctime.\n";
                    
                    usort($files, 'FileSystem_File::cmp_ctime');
                    break;
            }
            
            if ($direction != 'ASC') {
                rsort($files);
            }
            
        }
        
         return $files;
    }
    
    public function
        has_subdirectory($directory_name)
    {
        $subdirectories = $this->get_subdirectories();
        
        foreach ($subdirectories as $subdirectory) {
            if (basename($subdirectory->get_name()) == $directory_name) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    public function
        get_subdirectory($directory_name)
    {
        $requested_subdirectory = null;
        
        $subdirectories = $this->get_subdirectories();
        
        foreach ($subdirectories as $subdirectory) {
            if (basename($subdirectory->get_name()) == $directory_name) {
                $requested_subdirectory = $subdirectory;
                break;
            }
        }
        
        if (isset($requested_subdirectory)) {
            return $requested_subdirectory;
        } else {
            $error_message = "No directory called $directory_name in ";
            $error_message .= $this->get_pretty_name();
            
            throw new Exception($error_message);
        }
    }
    
    public function
        get_subdirectories()
    {
        $directories = array();
        
        foreach (glob($this->get_name() . '/*') as $directory_name) {
            if (is_dir($directory_name)) {
                $directories[] = new FileSystem_Directory($directory_name);
            }
        }
        
        return $directories;
    }
    
    public function
        get_subdirectories_recursively()
    {
        $search_list = $this->get_subdirectories();
        $subdirectories = array();
        
        while ($cur_dir = array_shift($search_list)) {
            #echo "\$cur_dir:\n";
            #print_r($cur_dir);
            
            foreach ($cur_dir->get_subdirectories() as $subdir) {
                $search_list[] = $subdir;
            }
            
            $subdirectories[] = $cur_dir;
        }
        
        return $subdirectories;
    }
    
    public function
        get_files_recursively()
    {
        $files = $this->get_files();
        
        $subdirs = $this->get_subdirectories_recursively();
        
        foreach ($subdirs as $subdir) {
            foreach ($subdir->get_files() as $file) {
                $files[] = $file;
            }
        }
        
        return $files;
    }
    
    public function
        get_files_by_extension($extension)
    {
        $files = $this->get_files();
        $files_with_extension = array();
        
        foreach ($files as $file) {
            if (preg_match("/\\.$extension$/i", $file->get_name())) {
                $files_with_extension[] = $file;
            }
        }
        
        return $files_with_extension;
    }
    
    public function
        get_files_by_extension_recursively($extension)
    {
        $files = $this->get_files_recursively();
        $files_with_extension = array();
        
        foreach ($files as $file) {
            if (preg_match("/\\.$extension$/i", $file->get_name())) {
                $files_with_extension[] = $file;
            }
        }
        
        return $files_with_extension;
    }

	public function	
		has_file($filename)
	{
		return is_file($this->get_name() . "/$filename");
	}
}
?>
