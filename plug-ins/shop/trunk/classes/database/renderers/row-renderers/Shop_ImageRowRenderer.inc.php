<?php
/**
 * Shop_ImageRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

/**
 * A class to render images from a database.
 */
class
    Shop_ImageRowRenderer
extends
    Database_ImageRowRenderer
{
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
            
            $full_size_image_url = $full_size_image_renderer->get_html_url_in_public_images();
            
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
