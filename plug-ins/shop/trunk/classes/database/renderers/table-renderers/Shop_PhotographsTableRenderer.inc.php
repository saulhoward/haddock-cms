<?php
/**
 * Shop_PhotographsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/'
    . 'Database_TableRenderer.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_DateTime.inc.php';

class
    Shop_PhotographsTableRenderer
extends
    Database_TableRenderer
{
    public function
        get_photograph_adding_form($photograph_adding_action, $cancel_location)
    {
        $mysql_user_factory = Database_MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_project(); 
        $database = $mysql_user->get_database();
        
        $photographs_table = $database->get_table('hpi_shop_photographs');

	$photograph_adding_form = new HTMLTags_SimpleOLForm('photograph_adding');
        $photograph_adding_form->set_attribute_str('enctype', 'multipart/form-data');
       
        #$photograph_adding_action->set_get_variable('table', $photographs_table->get_name());
    
        $photograph_adding_form->set_action($photograph_adding_action);
        
        $photograph_adding_form->set_legend_text('Add a photograph');
        
        /*
         * The name
         */
        $name_field = $photographs_table->get_field('name');
            
        $name_field_renderer = $name_field->get_renderer();
            
        $input_tag = $name_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'name');
        
        $photograph_adding_form->add_input_tag(
            'name',
            $input_tag
        );        
        
        /* THE FULL SIZE IMAGE UPLOAD */
        $full_size_image_file_input_tag = new HTMLTags_Input();

        $full_size_image_file_input_tag_name = 'display_photograph_file[]';

        $full_size_image_file_input_tag->set_attribute_str('type', 'file');
        $full_size_image_file_input_tag->set_attribute_str('id', $full_size_image_file_input_tag_name);
        $full_size_image_file_input_tag->set_attribute_str('name', $full_size_image_file_input_tag_name);

        $photograph_adding_form->add_input_tag(
            $full_size_image_file_input_tag_name,
            $full_size_image_file_input_tag,
            'Full Size File'
        );

        /* THE MEDIUM SIZE IMAGE UPLOAD */
        $medium_size_image_file_input_tag = new HTMLTags_Input();

        $medium_size_image_file_input_tag_name = 'medium_photograph_file[]';

        $medium_size_image_file_input_tag->set_attribute_str('type', 'file');
        $medium_size_image_file_input_tag->set_attribute_str('id', $medium_size_image_file_input_tag_name);
        $medium_size_image_file_input_tag->set_attribute_str('name', $medium_size_image_file_input_tag_name);

        $photograph_adding_form->add_input_tag(
            $medium_size_image_file_input_tag_name,
            $medium_size_image_file_input_tag,
            'Medium Size File'
        );

        /* THE THUMBNAIL IMAGE UPLOAD */
        $thumbnail_image_file_input_tag = new HTMLTags_Input();

        $thumbnail_image_file_input_tag_name = 'thumbnail_photograph_file[]';

        $thumbnail_image_file_input_tag->set_attribute_str('type', 'file');
        $thumbnail_image_file_input_tag->set_attribute_str('id', $thumbnail_image_file_input_tag_name);
        $thumbnail_image_file_input_tag->set_attribute_str('name', $thumbnail_image_file_input_tag_name);

        $photograph_adding_form->add_input_tag(
            $thumbnail_image_file_input_tag_name,
            $thumbnail_image_file_input_tag,
            'Thumbnail File'
        );
        $photograph_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');
        
        /*
         * The add button.
         */
        $photograph_adding_form->set_submit_text('Add');
        
        $photograph_adding_form->set_cancel_location($cancel_location);
        
        return $photograph_adding_form;
    }

    public function
        get_gallery_front_page_img()
        {
            $photographs_table = $this->get_element();
            $front_page_photograph_row = $photographs_table->get_front_page_photograph();
            #print_r($front_page_photograph_row);
            $front_page_photograph_row_renderer = $front_page_photograph_row->get_renderer();
            #print_r($front_page_photograph_row_renderer);
            return $front_page_photograph_row_renderer->get_full_size_img();
            
        }
    
    public function
        get_latest_photographs_rss()
        {
            $photographs_table = $this->get_element();
            
            $rss_intro_str = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <rss version=\"2.0\"
                    xmlns:media=\"http://search.yahoo.com/mrss/\"
                    xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
                    >
                <channel>" . "\n\t\t\t";
            
            $rss_outro_str = "
                </channel>
            </rss>";

            $rss_header_str = '';
            $rss_header_str .= "<title>Brighton Wok - Latest Photos</title>";
            $rss_header_str .= "<link>http://www.brighton-wok.com/gallery.html</link>";
            $rss_header_str .= "<description>A feed of photographs from the production of Brighton Wok</description>";
            $rss_header_str .= "<pubDate>" . date('Y-m-d') ."</pubDate>";
            $rss_header_str .= "<lastBuildDate>" . date('Y-m-d') ."</lastBuildDate>";       
            $rss_header_str .= "<generator>http://www.brighton-wok.com/</generator>" . "\n\t\t\t";
            
            $recent_photograph_rows = $photographs_table->get_all_rows('added', 'DESC', 0, 10);
            
            $rss_photos_strs_array = array();
            
            foreach ($recent_photograph_rows as $recent_photograph_row)
            {
                $recent_photograph_image_row = $recent_photograph_row->get_full_size_image();
                $recent_photograph_image_row_renderer = $recent_photograph_image_row->get_renderer();
                $recent_photograph_image_uri = $recent_photograph_image_row_renderer->get_html_url_in_public_images();
                
                $recent_photograph_thumbnail_row = $recent_photograph_row->get_thumbnail_image();
                $recent_photograph_thumbnail_row_renderer = $recent_photograph_thumbnail_row->get_renderer();
                $recent_photograph_thumbnail_uri = $recent_photograph_thumbnail_row_renderer->get_html_url_in_public_images();                

                $rss_str = '';
                $rss_str .= "<item>" . "\n\t\t\t\t";
                $rss_str .= "<title>" . $recent_photograph_row->get_name() . "</title>";
                $rss_str .= "<link>http://www.brighton-wok.com/?page=gallery&amp;photograph_id=" . $recent_photograph_row->get_id() . "</link>";
                
                $date_added =$recent_photograph_row->get_added();
                $date_added_human_readable = Formatting_DateTime::datetime_to_human_readable($date_added);
                
                $rss_str .= "<description>" . "&lt;img src=\"http://www.brighton-wok.com" . $recent_photograph_image_uri->get_as_string() . "\" alt=\"" . $recent_photograph_row->get_name() . "\" /&gt;&lt;p&gt;" . $recent_photograph_row->get_description() . "&lt;/p&gt;&lt;p&gt;Photograph added on " . $date_added_human_readable . "&lt;/p&gt;</description>";
                $rss_str .= "<pubDate>" . $recent_photograph_row->get_added() . "</pubDate>";
                $rss_str .= "<dc:date.Taken>" . $recent_photograph_row->get_added() . "</dc:date.Taken>";
                $rss_str .= "<author>photos@brighton-wok.com (Brighton Wok)</author>";
                
                $rss_str .= "<media:content url=\"http://www.brighton-wok.com" . $recent_photograph_image_uri->get_as_string() . "\"" . " type=\"" . $recent_photograph_image_row->get_file_type() . "\" />";
                $rss_str .= "<media:title>" . $recent_photograph_row->get_name() . "</media:title>";
                $rss_str .= "<media:text type=\"html\">" . $recent_photograph_row->get_description() . "</media:text>";
                $rss_str .= "<media:thumbnail url=\"http://www.brighton-wok.com" . $recent_photograph_thumbnail_uri->get_as_string() . "\" />";
                $rss_str .= "<media:credit role=\"photographer\">Connected Films</media:credit>";
                
                $tags = array();
                $tags = $recent_photograph_row->get_tags_strs();
                
                $rss_str .= "<media:category scheme=\"urn:flickr:tags\">";
                
                foreach ($tags as $tag)
                {
                     $rss_str .= $tag . " ";
                }
                
                $rss_str .= "</media:category>" . "\n\t\t\t";
                
                $rss_str .= "</item>" . "\n\t\t\t";
                
                $rss_photos_strs_array[] = $rss_str;
            }
            
            ################################
            # Build the RSS page
            ################################
            
            $rss_page = $rss_intro_str . $rss_header_str;
            
            foreach ($rss_photos_strs_array as $rss_photo_str)
            {
                $rss_page .= $rss_photo_str;   
            }
            
            $rss_page .= $rss_outro_str;

            return $rss_page;
        }
        
    
    public function
        get_latest_photographs_json()
        {
            $photographs_table = $this->get_element();
#            jsonFlickrFeed({
#		"title": "Everyone's Photos",
#		"link": "http://www.flickr.com/photos/",
#		"description": "A feed of Everyone's Photos",
#		"modified": "2007-04-12T17:31:37Z",
#		"generator": "http://www.flickr.com/",
#		"items": [

            $json_intro_str = "jsonBrightonWokPhotosFeed({
		\"title\": \"Brighton Wok - latest photographs\",
		\"link\": \"http://www.brighton-wok.com/gallery.html\",
		\"description\": \"the latest photographs from the production of Brighton Wok - The Legend of Ganja Boxing\",
		\"modified\": \"2007-04-12T17:31:37Z\",
		\"generator\": \"http://www.brighton-wok.com/\",
		\"items\": [" . "\n\t\t\t";
            
            $json_outro_str = "]})";
            
            $recent_photograph_rows = $photographs_table->get_all_rows('added', 'DESC', 0, 10);
            
            $json_photos_strs_array = array();
            
            $first = TRUE;
            foreach ($recent_photograph_rows as $recent_photograph_row)
            {
                $json_str = '';
                if ($first)
                {
                    $first = FALSE;                
                }
                else
                {
                    $json_str .= "," . "\n\t\t\t";
                }
                $recent_photograph_image_row = $recent_photograph_row->get_full_size_image();
                $recent_photograph_image_row_renderer = $recent_photograph_image_row->get_renderer();
                $recent_photograph_image_uri = $recent_photograph_image_row_renderer->get_html_url_in_public_images();
                
                $recent_photograph_thumbnail_row = $recent_photograph_row->get_thumbnail_image();
                $recent_photograph_thumbnail_row_renderer = $recent_photograph_thumbnail_row->get_renderer();
                $recent_photograph_thumbnail_uri = $recent_photograph_thumbnail_row_renderer->get_html_url_in_public_images();                
#	   {
#			"title": "IMG_0037",
#			"link": "http://www.flickr.com/photos/94309321@N00/456739651/",
#			"media": {"m":"http://farm1.static.flickr.com/199/456739651_199694a21b_m.jpg"},
#			"date_taken": "2007-04-11T21:17:11-08:00",
#			"description": "&lt;p&gt;&lt;a href=&quot;http://www.flickr.com/people/94309321@N00/&quot;&gt;baby_starkey&lt;/a&gt; posted a photo:&lt;/p&gt; &lt;p&gt;&lt;a href=&quot;http://www.flickr.com/photos/94309321@N00/456739651/&quot; title=&quot;IMG_0037&quot;&gt;&lt;img src=&quot;http://farm1.static.flickr.com/199/456739651_199694a21b_m.jpg&quot; width=&quot;240&quot; height=&quot;180&quot; alt=&quot;IMG_0037&quot; style=&quot;border: 1px solid #ddd;&quot; /&gt;&lt;/a&gt;&lt;/p&gt; ",
#			"published": "2007-04-12T17:31:37Z",
#			"author": "nobody@flickr.com (baby_starkey)",
#			"tags": ""
#	   },
                $json_str .= "{" . "\n\t\t\t\t";
                $json_str .= "\"title\": \"" . $recent_photograph_row->get_name() . "\"," . "\n\t\t\t\t";
                $json_str .= "\"link\": \"http://www.brighton-wok.com/?page=gallery&photograph_id=" . $recent_photograph_row->get_id() . "\"," . "\n\t\t\t\t";
                $json_str .= "\"media\": {\"m\":\"http://dev.brighton-wok.leon.clearlinewebdesign.com" . $recent_photograph_image_uri->get_as_string() . "\"}," . "\n\t\t\t\t";
                $json_str .= "\"date_taken\": \"" . $recent_photograph_row->get_added() . "\"," . "\n\t\t\t\t";
                $json_str .= "\"description\": \"&lt;img src=&quot;http://dev.brighton-wok.leon.clearlinewebdesign.com" . $recent_photograph_thumbnail_uri->get_as_string() . "&quot; width=&quot;100&quot; height=&quot;100&quot; alt=&quot;" . $recent_photograph_row->get_name() . "&quot; style=&quot;border: 1px solid #ddd;&quot; /&gt;&lt;p&gt;" . $recent_photograph_row->get_name() . "&lt;/p&gt;\"," . "\n\t\t\t\t";
                $json_str .= "\"published\": \"" . $recent_photograph_row->get_added() . "\"," . "\n\t\t\t\t";
                $json_str .= "\"author\": \"photos@brighton-wok.com (Brighton Wok)\"," . "\n\t\t\t\t";    

                $tags = array();
                $tags = $recent_photograph_row->get_tags_strs();
                
                $json_str .= "\"tags\": \"";
                
                foreach ($tags as $tag)
                {
                     $json_str .= $tag . " ";
                }
                
                $json_str .= "\"," . "\n\t\t\t";
                
                $json_str .= "}";
                
                $json_photos_strs_array[] = $json_str;
            }
            
            ################################
            # Build the json page
            ################################
            
            $json_page = $json_intro_str;
            
            foreach ($json_photos_strs_array as $json_photo_str)
            {
                $json_page .= $json_photo_str;   
            }
            
            $json_page .= $json_outro_str;

            return $json_page;
        }
}
?>
