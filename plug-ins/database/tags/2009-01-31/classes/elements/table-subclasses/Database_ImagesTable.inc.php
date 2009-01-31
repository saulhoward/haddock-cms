<?php
/**
 * Database_ImagesTable
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Table.inc.php';

/**
 * A class to represent a table of images.
 */
class
    Database_ImagesTable
extends
    Database_Table
{
    /**
     * Adds an image file to the database table.
     *
     * @param $file As in $_FILE from a form.
     */
    public function
        add_image_file(
            $file
        )
    {
        #print_r($file);

        $image_ids = array();

        $mime = $file['type'][0];

        $content = file_get_contents($file['tmp_name'][0]);
        $content = gzdeflate($content);

        $values['file_type'] = $mime;
        $values['image'] = $content;

        #print_r($values);

        return $this->add($values);
    }

    public function
        add_local_image_file($file_name)
    {
        if (preg_match('/\.(\w+)/', $file_name, $matches)) {
            $ext = strtoupper($matches[1]);

            switch ($ext) {
                case 'PNG':
                    $mime = 'image/png';
                    break;
                case 'GIF':
                    $mime = 'image/gif';
                    break;
                case 'JPG':
                default:
                    $mime = 'image/jpeg';
                    break;
            }

            return $this->add_local_file_with_mimetype($file_name, $mime);
        }
    }
    
    public function
        add_local_file_with_mimetype(
            $file_name,
            $mime
        )
    {
        $content = file_get_contents($file_name);
        $content = gzdeflate($content);

        $values['file_type'] = $mime;
        $values['image'] = $content;

        #print_r($values);

        return $this->add($values);
    }

    public function
        get_cache_dir_name()
    {
        return PROJECT_ROOT . '/hc-database-img-cache';
    }

    /**
     * We also need to delete the images in the cache.
     */
    public function
        delete_all()
    {
        parent::delete_all();

        foreach (glob($this->get_cache_dir_name() . '/*') as $cache_file) {
            unlink($cache_file);
        }
    }

    public function
        delete_by_id($id)
    {
        parent::delete_by_id($id);

        $cache_files = glob($this->get_cache_dir_name() . '/' . $id . '.*');

        //echo 'print_r($cache_files): ' . "\n";
        //print_r($cache_files);

        foreach ($cache_files as $cache_file) {

            unlink($cache_file);
        }
    }
}
?>
