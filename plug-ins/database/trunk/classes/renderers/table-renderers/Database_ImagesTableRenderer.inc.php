<?php
/**
 * Database_ImagesTableRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

/**
 * A class to render Images Tables
 */
class
    Database_ImagesTableRenderer
extends
    Database_TableRenderer
{
    public function render_row_adding_form()
    {
        $images_table = $this->get_element();
        
?>
<form
    name="image_management"
    enctype="multipart/form-data"
    action="/admin/index.php?module=database&page=table&table=<?php echo $images_table->get_name(); ?>"
    method="POST"
    class="basic-form"
>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <fieldset>
        <legend>Image Upload</legend>
        <ol>
            <li>
                <label for="user_file[]">Image File<em>*</em></label>
                <input name="user_file[]" type="file" />
            </li>
        </ol>
        <ul class="yes-no">
            <li>
                <input
                    type="submit"
                    value="Add"
                />
            </li>
            <li>
                <input
                    type="button"
                    value="Cancel"
                    onclick="document.location.href='/admin/index.php?module=database&page=table&table=<?php echo $images_table->get_name(); ?>'"
                />
            </li>
        
        </ul>
    </fieldset>
</form>
<?php
    }
    
    public function
        get_row_adding_form(
            HTMLTags_URL $row_adding_action,
            HTMLTags_URL $cancel_href
        )
    {
        $table = $this->get_element();
        
        $row_adding_form = new HTMLTags_SimpleOLForm('images_adding');
        
        $row_adding_form->set_attribute_str('enctype', 'multipart/form-data');
        $row_adding_form->set_attribute_str('class', 'basic-form');
        
        $file_input_tag = new HTMLTags_Input();
        
        $file_input_tag_name = 'user_file[]';
        
        $file_input_tag->set_attribute_str('type', 'file');
        $file_input_tag->set_attribute_str('id', $file_input_tag_name);
        $file_input_tag->set_attribute_str('name', $file_input_tag_name);
        
        $row_adding_form->add_input_tag(
            $file_input_tag_name,
            $file_input_tag,
            'Image File'
        );
        
        $row_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');
        
        $row_adding_form->add_hidden_input('add_image', 1);
        
        $row_adding_form->set_action($row_adding_action);
        
        $row_adding_form->set_legend_text('Add an image.');
        
        $row_adding_form->set_submit_text('Add');
        
        $row_adding_form->set_cancel_location($cancel_href);
        
        return $row_adding_form;
    }
    
    /**
     * All image tables must have the same columns
     * at this point.
     *
     *  id
     *  file_type
     *  image
     */
    public function render_all_data_table_header($ordered_by = 'id', $current_sort_direction = 'ASC')
    {
?>
<tr>
    <th>Id</th>    
    <th>File Type</th>    
    <th>Image</th>            
    <th>Delete</th>
</tr>
<?php
    }
    
    public function
        get_admin_database_action_ths()
    {
        $ths = array();
        
        $ths[] = new HTMLTags_TH('Delete');
        
        return $ths;
    }
    
    public function
        get_admin_database_selection_html_table(
            $order_by,
            $direction,
            $offset,
            $limit
        )
    {
        $url = $this->get_admin_page_url();
        
        $table = $this->get_element();
        
        $fields = array();
        
        //foreach (explode(' ', 'id image') as $field_str) {
        //    $field_obj = $table->get_field($field_str);
        foreach ($table->get_fields() as $field_obj) {
            $field['sortable'] = ($field_obj->get_name() != 'image');
            
            $field['name'] = $field_obj->get_name();
            
            $field['method'] = 'get_data_html_table_td';
            
            $method_args = array();
            $method_args[] = $field_obj;
            $field['method_args'] = $method_args;
            
            $fields[] = $field;
        }
        
        $actions = array();

        $delete_action['th'] = new HTMLTags_TH('Delete');
        $delete_action['method'] = 'get_admin_database_tr_action_delete_td';

        $actions[] = $delete_action;
        
        #print_r($actions);
        
        return new Database_SelectionHTMLDiv(
            $url,
            $table,
            $order_by,
            $direction,
            $offset,
            $limit,
            $limit_str = '10 20 50',
            'Images in the ' . $table->get_name() . ' table',
            'table_pages_div',
            'table_pages',
            $fields,
            $actions
        );
    }
    
    public static function
		render_hc_database_img($id, $file_type)
	{
		#echo "In render_hc_database_img\n"; exit;
		
		echo "<img src=\"/hc-database-img-cache/";
		echo $id;
		#echo '.';
		echo self::mime_type_to_extension($file_type);
		echo "\" />\n";
		
		#exit;
	}
    
    public static function
		mime_type_to_extension($mime_type)
	{
		switch ($mime_type) {
			case 'image/jpeg':
			case 'image/pjpeg':
				return ".jpg";
			case 'image/png':
				return ".png";
			case 'image/gif':
				return ".gif";
		}
	}
}
?>