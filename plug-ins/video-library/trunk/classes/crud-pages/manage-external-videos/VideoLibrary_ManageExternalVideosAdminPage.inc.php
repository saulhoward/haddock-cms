<?php
/**
 * VideoLibrary_ManageExternalVideosAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
VideoLibrary_ManageExternalVideosAdminPage
extends
Database_CRUDAdminPage
{
    protected function
        render_head_link_stylesheet()
    {
        parent::render_head_link_stylesheet();
        HTMLTags_LinkRenderer::render_style_sheet_link('/plug-ins/video-library/public-html/styles/admin-styles.css');

        echo <<<HTML
<script type="text/javascript" 
         src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" 
         src="/plug-ins/video-library/public-html/scripts/VideoLibrary_ManageExternalVideosPage.js"></script>
HTML;


    }


    protected function
        get_admin_crud_manager_class_name()
    {
        return 'VideoLibrary_ExternalVideosCRUDManager';
    }

    protected function
        get_data_table_fields()
    {
        return array(
            array(
                'col_name' => 'date_added',
                'filter' => 'return date("F j, Y", strtotime($str));'
            ),
            array(
                'col_name' => 'id',
                'filter' => 'return VideoLibrary_DatabaseHelper::get_external_video_library_name_for_external_video_id($str);',
                'title' => 'Library'

            ),
            array(
                'col_name' => 'thumbnail_url',
                'filter' => 'return VideoLibrary_DisplayHelper::get_thumbnail_img($str)->get_as_string();',
                'title' => 'Thumbnail'
            ),
            array(
                'col_name' => 'id',
                'filter' => 'return VideoLibrary_ManageExternalVideosAdminPage::get_thumbnail_queue_link($str);',
                'title' => 'Requeue'
            ),

            array(
                'col_name' => 'name'
            ),
            array(
                'col_name' => 'length_seconds',
                'filter' => 'return VideoLibrary_DisplayHelper::get_minutes_from_seconds($str);',
                'title' => 'Length (min)'
            ),
            array(
                'col_name' => 'external_video_provider_id',
                'filter' => 'return VideoLibrary_DatabaseHelper::get_external_video_provider_name_for_id($str);',
                'title' => 'Provider'
            ),
            array(
                'col_name' => 'providers_internal_id'
            ),
            array(
                'col_name' => 'id',
                'filter' => 'return VideoLibrary_DisplayHelper::get_tags_csv_string( VideoLibrary_DatabaseHelper::get_tags_for_external_video_id($str));',
                'title' => 'Tags'
            ),
            array(
                'col_name' => 'status'
            )

        );
    }

    protected function
        get_thumbnail_queue_link($id)
    {
        $div = new HTMLTags_Div();

        $u = $this->get_redirect_script_url();
        $u->set_get_variable('action', 'add_video_to_thumbnail_queue');
        $u->set_get_variable('id', $id);

        $a = new HTMLTags_A('Refetch Thumbnail');
        $a->set_href($u);
        $div->append($a);

        return $div->get_as_string();   
    }

    protected function
        get_matching_query_from_clause()
    {
        return <<<SQL
FROM
    hpi_video_library_external_videos

SQL;

    }

    protected function
        render_add_something_form_ol()
    {
        $acm = $this->get_admin_crud_manager();

        echo "<ol>\n";
        $library_values = VideoLibrary_DatabaseHelper
            ::get_external_video_libraries(TRUE);
        //$library_li = '<li><label for="external_video_library_id">Library</label><select name="external_video_library_id">';
        //foreach ($library_values as $library_value) {
        //$library_li .= '<option value="' . $library_value['id'] . '">' . $library_value['name'] . '</option>';
        //}
        //$library_li .= '</select></li>';

        $library_li = '<li><label for="external_video_library_id">Library</label><div class="radio-inputs">';
        $i = 0;
        foreach ($library_values as $library_value) {
            $library_li .= '<label><input type="radio" name="external_video_library_id" value="' . $library_value['id'] . '"';
            if ($i == 0) $library_li .= ' checked="checked"';
            $i++; 
            $library_li .= '>';
            $library_li .= $library_value['name'] . '<br />';
        }
        $library_li .= '</label></div></li>';


        echo $library_li;

        $provider_values = VideoLibrary_DatabaseHelper
            ::get_external_video_providers();
        //$provider_li = '<li><label for="external_video_provider_id">Provider</label><select name="external_video_provider_id">';
        //foreach ($provider_values as $provider_value) {
        //$provider_li .= '<option value="' . $provider_value['id'] . '">' . $provider_value['name'] . '</option>';
        //}
        //$provider_li .= '</select></li>';

        $provider_li = '<li><label for="external_video_provider_id">Provider</label><div class="radio-inputs">';
        $i = 0;
        foreach ($provider_values as $provider_value) {
            $provider_li .= '<label><input type="radio" name="external_video_provider_id" value="' . $provider_value['id'] . '"';
            if ($i == 0) $provider_li .= ' checked="checked"';
            $i++; 
            $provider_li .= '>';
            $provider_li .= $provider_value['name'] . '<br />';
        }
        $provider_li .= '</label></div></li>';


        echo $provider_li;

        $this->render_add_something_form_li_text_input('name');
        $this->render_add_something_form_li_text_input('providers_internal_id');

        $status_values = VideoLibrary_DatabaseHelper
            ::get_enum_values(
                'hpi_video_library_external_videos',
                'status'
            );
        $status_li = '<li><label for="status">Status</label><select name="status">';
        foreach ($status_values as $status_value) {
            $status_li .= '<option value="' . $status_value . '">' . $status_value . '</option>';
        }
        $status_li .= '</select></li>';
        echo $status_li;

        echo '<fieldset id="tags-fieldset"><legend>Tags</legend>';
        $this->render_add_something_form_li_text_input('tags');
        echo VideoLibrary_DisplayHelper::get_tags_empty_links_list(
            VideoLibrary_DatabaseHelper::get_tags(TRUE)
        )->get_as_string();
        echo '</fieldset>';


        echo "</ol>\n";
    }

    protected function
        render_edit_something_form_ol()
    {
        $acm = $this->get_admin_crud_manager();

        echo "<ol>\n";

        $library_values = VideoLibrary_DatabaseHelper
            ::get_external_video_libraries(TRUE);
        //$library_li = '<li><label for="external_video_library_id">Library</label><select name="external_video_library_id">';
        //foreach ($library_values as $library_value) {
        //$library_li .= '<option value="' . $library_value['id'] . '"';
        //$cur_library_value = VideoLibrary_DatabaseHelper
        //::get_external_video_library_id_for_external_video_id($_GET['id']);
        //if ($cur_library_value == $library_value['id']) {
        //$library_li .= ' selected="selected"';
        //}
        //$library_li .= '>' . $library_value['name'] . '</option>';
        //}
        //$library_li .= '</select></li>';

        $library_li = '<li><label for="external_video_library_id">Library</label><div class="radio-inputs">';
        foreach ($library_values as $library_value) {
            $library_li .= '<label><input type="radio" name="external_video_library_id" value="' . $library_value['id'] . '"';
            $cur_library_value = VideoLibrary_DatabaseHelper
                ::get_external_video_library_id_for_external_video_id($_GET['id']);
            if ($cur_library_value == $library_value['id']) {
                $library_li .= ' checked="checked"';
            }
            $library_li .= '>';
            $library_li .= $library_value['name'] . '<br />';
        }
        $library_li .= '</label></div></li>';


        echo $library_li;


        $provider_values = VideoLibrary_DatabaseHelper
            ::get_external_video_providers();
        //$provider_li = '<li><label for="external_video_provider_id">Provider</label><select name="external_video_provider_id">';
        //foreach ($provider_values as $provider_value) {
        //$provider_li .= '<option value="' . $provider_value['id'] . '"';
        //$cur_provider_value = ($acm->has_current_var('external_video_provider_id') ? $acm->get_current_var('external_video_provider_id') : NULL);
        //if ($cur_provider_value == $provider_value['id']) {
        //$provider_li .= ' selected="selected"';
        //}
        //$provider_li .= '>' . $provider_value['name'] . '</option>';
        //}
        //$provider_li .= '</select></li>';

        $provider_li = '<li><label for="external_video_provider_id">Provider</label><div class="radio-inputs">';
        foreach ($provider_values as $provider_value) {
            $provider_li .= '<label><input type="radio" name="external_video_provider_id" value="' . $provider_value['id'] . '"';
            $cur_provider_value = ($acm->has_current_var('external_video_provider_id') ? $acm->get_current_var('external_video_provider_id') : NULL);
            if ($cur_provider_value == $provider_value['id']) {
                $provider_li .= ' checked="checked"';
            }
            $provider_li .= '>';
            $provider_li .= $provider_value['name'] . '<br />';
        }
        $provider_li .= '</label></div></li>';


        echo $provider_li;

        $this->render_edit_something_form_li_text_input('name');
        $this->render_edit_something_form_li_text_input('providers_internal_id');

        $status_values = VideoLibrary_DatabaseHelper
            ::get_enum_values(
                'hpi_video_library_external_videos',
                'status'
            );
        $status_li = '<li><label for="status">Status</label><select name="status">';
        foreach ($status_values as $status_value) {
            $status_li .= '<option value="' . $status_value . '"';
            $cur_status_value = ($acm->has_current_var('status') ? $acm->get_current_var('status') : NULL);
            if ($cur_status_value == $status_value) {
                $status_li .= ' selected="selected"';
            }
            $status_li .= '>' . $status_value . '</option>';
        }
        $status_li .= '</select></li>';

        echo $status_li;

        echo '<fieldset id="tags-fieldset"><legend>Tags</legend>';
        echo '<li><label for="tags">Tags</label>';
        echo '<input type="text" name="tags" id="tags" value ="';

        echo VideoLibrary_DisplayHelper::get_tags_csv_string(
            VideoLibrary_DatabaseHelper::get_tags_for_external_video_id($_GET['id'])
        );
        echo '" />';
        echo VideoLibrary_DisplayHelper::get_tags_empty_links_list(
            VideoLibrary_DatabaseHelper::get_tags(TRUE)
        )->get_as_string();

        echo '</fieldset>';

        echo "</ol>\n";
    }

    protected function
        get_add_something_title()
    {
        return 'Add an External Video';
    }

    protected function
        get_body_div_header_heading_content()
    {
        return 'External Videos';
    }

    protected function
        get_other_page_link_as()
    {
        $as = array();

        /**
         * Link to the delete all confirmation page.
         */
        $add_something_a = new HTMLTags_A($this->get_add_something_title());

        $add_something_href = $this->get_current_base_url();
        $add_something_href->set_get_variable('content', 'add_something');

        $add_something_a->set_href($add_something_href);

        $as[] = $add_something_a;


        /**
         * Link to the delete all confirmation page.
         */
        $delete_all_a = new HTMLTags_A($this->get_delete_everything_link_text());

        $delete_all_href = $this->get_current_base_url();
        $delete_all_href->set_get_variable('content', 'delete_everything');

        $delete_all_a->set_href($delete_all_href);

        $as[] = $delete_all_a;

        return $as;
    }

    protected function
        get_delete_everything_title()
    {
        return 'Delete All Videos';
    }

    protected function
        get_content_render_method_map()
    {
        $crmm = parent::get_content_render_method_map();
        $crmm['view_video'] = 'render_content_to_view_a_video';

        return $crmm;
    }

    protected function
        get_data_table_actions()
    {
        $eval_template = $this->get_data_table_actions_content_eval_template();

        return array(
            array(
                'name' => 'view',
                'filter' => sprintf($eval_template, 'view_video')
            ),
            array(
                'name' => 'edit',
                'filter' => sprintf($eval_template, 'edit_something')
            ),
            array(
                'name' => 'delete',
                'filter' => sprintf($eval_template, 'delete_something')
            )
        );
    }

    public function
        render_content_to_view_a_video()
    {
        echo $this->get_back_link_p();
        if (isset($_GET['id'])) {
            echo VideoLibrary_DisplayHelper::get_admin_view_video_div(
                VideoLibrary_DatabaseHelper::get_external_video_data(
                    $_GET['id']
                )
            );
        } else {
            echo '<p>Form ID not set!</p>';
        }
        echo $this->get_back_link_p();
    }

    protected function
        get_data_table_caption_content_explanation_part()
    {
        return 'Video';
    }

    protected function
        get_confirm_deleting_everything_question_object()
    {
        return 'all of the Videos';
    }
}
?>
