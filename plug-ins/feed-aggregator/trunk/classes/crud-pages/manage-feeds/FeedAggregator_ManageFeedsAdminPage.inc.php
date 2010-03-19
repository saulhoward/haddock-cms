<?php
/**
 * FeedAggegator_ManageFeedsAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
FeedAggegator_ManageFeedsAdminPage
extends
Database_CRUDAdminPage
{
    protected function
        render_head_link_stylesheet()
    {
        parent::render_head_link_stylesheet();
        HTMLTags_LinkRenderer::render_style_sheet_link('/plug-ins/video-library/public-html/styles/admin-styles.css');
    }

    protected function
        get_admin_crud_manager_class_name()
    {
        return 'FeedAggegator_FeedsCRUDManager';
    }

    protected function
        get_data_table_fields()
    {
        return array(
            array(
                'col_name' => 'name'
            ),
            array(
                'col_name' => 'title'
            ),
            array(
                'col_name' => 'url'
            ),
            array(
                'col_name' => 'format'
            ) 
        );
    }

    protected function
        get_matching_query_from_clause()
    {
        return <<<SQL
FROM
    hpi_feed_aggregator_feeds

SQL;

    }

    protected function
        render_add_something_form_ol()
    {
        $acm = $this->get_admin_crud_manager();

        echo "<ol>\n";

        $this->render_add_something_form_li_text_input('name');
        $this->render_add_something_form_li_text_input('title');
        $this->render_add_something_form_li_text_input('description');
        $this->render_add_something_form_li_text_input('url');
        $this->render_add_something_form_li_text_input('format');

        echo "</ol>\n";

        echo $this->get_form_help_message();
    }

    public function
        get_form_help_message()
    {
        return <<<HTML
<div>
<ul>
    <li>
        'Name' must be a unique string with only alphanumerical characters and underscores.
    </li>
    <li>
        'Format' should be a Haddock class inheriting from FeedAggregator_Feed
    </li>
</ul>
</div>
HTML;

    }

    protected function
        render_edit_something_form_ol()
    {
        $acm = $this->get_admin_crud_manager();

        echo "<ol>\n";
        $this->render_edit_something_form_li_text_input('name');
        $this->render_edit_something_form_li_text_input('title');
        $this->render_edit_something_form_li_text_input('description');
        $this->render_edit_something_form_li_text_input('url');
        $this->render_edit_something_form_li_text_input('format');
        echo "</ol>\n";

        echo $this->get_form_help_message();
    }

    protected function
        get_add_something_title()
    {
        return 'Add a Feed';
    }

    protected function
        get_body_div_header_heading_content()
    {
        return 'Feeds';
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
        return 'Delete all Feeds';
    }

    protected function
        get_content_render_method_map()
    {
        $crmm = parent::get_content_render_method_map();
        // $crmm['view_video'] = 'render_content_to_view_a_video';

        return $crmm;
    }

    protected function
        get_data_table_actions()
    {
        $eval_template = $this->get_data_table_actions_content_eval_template();

        return array(
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

    protected function
        get_data_table_caption_content_explanation_part()
    {
        return 'Feed';
    }

    protected function
        get_confirm_deleting_everything_question_object()
    {
        return 'all of the Feeds';
    }

    protected function
        get_default_order_by()
    {
        return "title";
    }

    protected function
        get_default_direction()
    {
        return 'DESC';
    }
}
?>