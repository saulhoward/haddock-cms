<?php
/**
 * Database_ImageRow
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Row.inc.php';

/**
 * A class to represent an image in a database table.
 */
class
    Database_ImageRow
extends
    Database_Row
{
    #############
    # Accessors #
    #############
    
    public function get_file_type()
    {
        $file_type = $this->get('file_type');
        
        /*
         * Hack for images uploaded from IE7.
         */
        if ($file_type == 'image/pjpeg') {
            $file_type = 'image/jpeg';
        }
        
        return $file_type;
    }
    
    public function get_file_extension()
    {
        $file_type = $this->get_file_type();
        
        switch ($file_type) {
            case 'image/jpeg':
                return 'jpg';
            case 'image/png':
                return 'png';
            case 'image/gif':
                return 'gif';
        }
    }
    
    public function get_image()
    {
        $image = $this->get('image');
        
        #$image = stripslashes($image);
        $image = gzinflate($image);
        
        return $image;
    }
    
    ############################
    # Methods to get renderers #
    ############################
    
    #public function get_renderer_class_filename()
    #{
    #    return CLWD_CORE_ROOT . '/database/renderers/row-renderers/ImageRowRenderer.inc.php';
    #}
    #
    #public function get_renderer_class_name()
    #{
    #    return 'ImageRowRenderer';
    #}
}

?>
