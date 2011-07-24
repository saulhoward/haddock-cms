<?php
/**
 * Shop_PhotographsTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
    Shop_PhotographsTable
extends
    Database_Table
{
    public function
        add_photograph (
            $name,
            $display_photograph_file,
            $medium_photograph_file,
            $thumbnail_photograph_file
        )
    {
    
    $files[] = $display_photograph_file;
    $files[] = $medium_photograph_file;
    $files[] = $thumbnail_photograph_file;
    $returned_image_ids = $this->add_image_files($files);
        
    $photograph_values = array();
        $photograph_values['name'] = $name;
        $photograph_values['full_size_image_id'] = $returned_image_ids['display'];
        $photograph_values['medium_size_image_id'] = $returned_image_ids['medium'];
        $photograph_values['thumbnail_image_id'] = $returned_image_ids['thumbnail'];
        $photograph_values['added'] = 'NOW()';
        
    $photograph_id = $this->add($photograph_values);
    
    return $photograph_id;
    }

    public function
        edit_photograph (
            $edit_id,
            $name
        )
    {
    
    $photograph_values = array();
        $photograph_values['name'] = $name;
        
    $this->update_by_id($edit_id, $photograph_values);
    
    }

    public function
        delete_photograph (
            $delete_id
        )
    {
        $database = $this->get_database();
        
        $images_table = $database->get_table('hc_database_images');
        
        $photograph_row = $this->get_row_by_id($delete_id);
        
        #
        #Delete from Images table
        #
        $images_table->delete_by_id($photograph_row->get_full_size_image_id());
        $images_table->delete_by_id($photograph_row->get_medium_size_image_id());
        $images_table->delete_by_id($photograph_row->get_thumbnail_image_id());
        
        #
        #Delete from Photographs table
        #
        $this->delete_by_id($photograph_row->get_id());
        
    }

    /**
     * Move to Database_ImagesTable?
     */
    public function
        add_image_files(
            $files
        )
    {
        #print_r($file);
            $database = $this->get_database();
            $images_table = $database->get_table('hc_database_images');
            
            $image_ids = array();

            foreach ($files as $file) {
                
                $size = $file['size'][0];
                $mime = $file['type'][0];
                $file_name = basename($file['name'][0]);
                
                $content = file_get_contents($file['tmp_name'][0]);
                $content = gzdeflate($content);
                
                $values['file_type'] = $mime;
                $values['image'] = $content;
                
                #print_r($values);
                $image_ids[] = $images_table->add($values);
            }
            
            $returned_image_ids['display'] = $image_ids[0];
            $returned_image_ids['medium'] = $image_ids[1];
            $returned_image_ids['thumbnail'] = $image_ids[2];
            
            return $returned_image_ids;
    }

    public function
        get_random_photograph()
    {
        return $this->get_random_row();
    }

    }
?>
