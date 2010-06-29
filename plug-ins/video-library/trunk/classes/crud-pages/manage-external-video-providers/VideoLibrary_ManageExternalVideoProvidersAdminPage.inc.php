<?php
/**
 * VideoLibrary_ManageExternalVideoProvidersAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
	VideoLibrary_ManageExternalVideoProvidersAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_ExternalVideoProvidersCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'name'
			),
			array(
				'col_name' => 'url'
			),
			array(
				'col_name' => 'status'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_video_library_external_video_providers
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_add_something_form_li_text_input('name');
		$this->render_add_something_form_li_text_input('url');
		//$this->render_add_something_form_li_text_input('status');

		$status_values = VideoLibrary_DatabaseHelper
			::get_enum_values(
				'hpi_video_library_external_video_providers',
				'status'
			);
		$status_li = '<li><label for="status">Status</label><select name="status">';
		foreach ($status_values as $status_value) {
			$status_li .= '<option value="' . $status_value . '">' . $status_value . '</option>';
		}
		$status_li .= '</select></li>';

		echo $status_li;

		$this->render_add_something_form_li_text_input('haddock_class_name');
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_text_input('name');
		$this->render_edit_something_form_li_text_input('url');
	
		$status_values = VideoLibrary_DatabaseHelper
			::get_enum_values(
				'hpi_video_library_external_video_providers',
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

		$this->render_edit_something_form_li_text_input('haddock_class_name');
		
	
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add an External Video Provider';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'External Video Providers';
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
		// $delete_all_a = new HTMLTags_A($this->get_delete_everything_link_text());
		// $delete_all_href = $this->get_current_base_url();
		// $delete_all_href->set_get_variable('content', 'delete_everything');
		// $delete_all_a->set_href($delete_all_href);
		// $as[] = $delete_all_a;
		
		return $as;
	}

	protected function
		get_delete_everything_title()
	{
		return 'Delete All Video Providers';
	}

	protected function
		get_content_render_method_map()
	{
		$crmm = parent::get_content_render_method_map();
		$crmm['view_provider'] = 'render_content_to_view_a_provider';
		
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
            )
        );	
		// return array(
			// array(
				// 'name' => 'view',
				// 'filter' => sprintf($eval_template, 'view_provider')
			// ),
			// array(
				// 'name' => 'edit',
				// 'filter' => sprintf($eval_template, 'edit_something')
			// ),
			// array(
				// 'name' => 'delete',
				// 'filter' => sprintf($eval_template, 'delete_something')
			// )
		// );
	}

	public function
		render_content_to_view_a_provider()
	{
		// echo $this->get_back_link_p();
		// if (isset($_GET['id'])) {
			// $tag_array = array();
			// $tag_array[] = $_GET['id'];
			// echo VideoLibrary_DisplayHelper::get_admin_view_provider_div(
				// VideoLibrary_DatabaseHelper
				// ::get_all_external_videos_for_provider_id_on_admin_page($tag_array)
			// )->get_as_string();
		// } else {
			// echo '<p>Form ID not set!</p>';
		// }
		// echo $this->get_back_link_p();
	}

	protected function
		get_data_table_caption_content_explanation_part()
	{
		return 'Video Providers';
	}

	protected function
		get_confirm_deleting_everything_question_object()
	{
		return 'all of the Video Providers';
	}
}
?>
