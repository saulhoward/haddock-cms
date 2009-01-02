<?php
/**
 * Database_ImageRowRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/renderers/'
#    . 'Database_RowRenderer.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_IMG.inc.php';

/**
 * A class to render images from a database.
 */
class
    Database_ImageRowRenderer
extends
    Database_RowRenderer
{
    public function render_table_row()
    {
        $row = $this->get_element();
        $table = $row->get_table();
        
?>
<tr>
    <td><?php echo $row->get_id(); ?></td>
    <td><?php echo $row->get_file_type(); ?></td>
    <td><?php $this->render_img_in_database(); ?></td>
    <td><a href="/admin/index.php?module=database&page=table&table=<?php echo $table->get_name(); ?>&delete_id=<?php echo $row->get_id(); ?>">Delete</a></td>
</tr>
<?php
    }
    
    public function render_img_in_database()
    {
        $row = $this->get_element();
        $table = $row->get_table();
        
        echo '<img src="/database/images/'
                . $table->get_name() . '/image-' . $row->get_id() . '.' . $row->get_file_extension()
            . "\" />\n";
    }
    
    public function
        get_html_url_in_public_images()
    {
        $image_row = $this->get_element();
        
        $html_url = new HTMLTags_URL();
        
        $html_url->set_file(
            #'/db-images/image-'
            '/hc-database-img-cache/'
            . $image_row->get_id()
            . '.'
            . $image_row->get_file_extension()
        );
        
        return $html_url;
    }
    
    public function get_img_in_public_images()
    {
        //echo "Entererd Database_ImageRowRenderer::get_img_in_public_images()\n";
        #exit;
        
        $img = new HTMLTags_IMG();
        
        $img->set_src($this->get_html_url_in_public_images());
        
        return $img;
    }
    
    public function
        get_data_html_table_td(Database_Field $field)
    {
        //echo "Entered Database_ImageRowRenderer::get_data_html_table_td(...)\n";
        #exit;
        
        if ($field->get_name() == 'image') {
            $field_renderer = $field->get_renderer();
            
            $img_tag = $this->get_img_in_public_images();
            
            //echo "Returned to Database_ImageRowRenderer::get_data_html_table_td(...)\n";
            #exit;
            
            $data_html_table_td
            //    = $field_renderer->get_data_html_table_td(
            //        $img_tag->get_as_string()
            //    );
                = new HTMLTags_TD();
                
            $data_html_table_td->append_tag_to_content($img_tag);
            
            //echo 'print_r($data_html_table_td): ' . "\n";
            //print_r($data_html_table_td);
            //
            //echo "Returned to Database_ImageRowRenderer::get_data_html_table_td(...)\n";
            #exit;
            
            return $data_html_table_td;
        } else {
            return parent::get_data_html_table_td($field);
        }
    }
    
    public function
        get_admin_database_tr_action_tds()
    {
        $tds[] = $this->get_admin_database_tr_action_delete_td();
        
        return $tds;
    }
    
    public function
        get_data_html_table_td_with_image(Database_Field $field)
    {
        $row = $this->get_element();
        
        if (
            $field->get_name() == 'image'
            &&
            $row->has_full_size_image()
        ) {
            #print_r($field);
            
            $field_renderer = $field->get_renderer();
            
            $img_tag = $this->get_img_in_public_images();
            #print_r($img_tag);
            
            $full_a = new HTMLTags_A();
            
            $full_size_image = $row->get_full_size_image();
            #print_r($full_size_image);
            
            $full_size_image_renderer = $full_size_image->get_renderer();
            
            $full_size_image_url
                = $full_size_image_renderer->get_html_url_in_public_images();
            
            $full_a->set_href($full_size_image_url);
            
            $full_a->append_tag_to_content($img_tag);
            
            $data_html_table_td
                = $field_renderer->get_data_html_table_td(
                    $full_a->get_as_string()
                );
            
            return $data_html_table_td;
        } else {
            return parent::get_data_html_table_td($field);
        }
    }
}

?>
