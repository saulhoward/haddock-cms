<?php
/**
 * Database_AdminXMLPageManager
 *
 * @copyright Clear Line Web Design, 2007-11-02
 */

class
	Database_AdminXMLPageManager
{
	private $xml_file_name_stem;
	private $xml_file;

	private $simple_xml_element;

	private $db_section;
	private $db_module;

	private $current_limit;
	private $current_offset;
	private $current_order_by;
	private $current_direction;

	private $available_limits;
	private $total_row_count_method_name;
	private $selection_method_name;

	public function
		__construct(
			$xml_file_name_stem,
			$db_section,
			$db_module = NULL
		)
	{
		$this->xml_file_name_stem = $xml_file_name_stem;

		$this->db_section = $db_section;
		$this->db_module = $db_module;

		$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		$pd = $pdf->get_project_directory_for_this_project();

		$md = $pd->get_module_directory($db_section, $db_module);

		$this->xml_file = $md->get_db_admin_xml_file($xml_file_name_stem);
	}

	public function
		get_xml_file_name_stem()
	{
		return $this->xml_file_name_stem;
	}

	public function
		get_simple_xml_element()
	{
		if (!isset($this->simple_xml_element)) {
			$this->simple_xml_element = new SimpleXMLElement(
				file_get_contents($this->xml_file->get_name())
			);
		}

		return $this->simple_xml_element;
	}

	public function
		get_db_section()
	{
		return $this->db_section;
	}

	public function
		has_db_module()
        {
                return isset($this->db_module);
        }

	public function
		get_db_module()
	{
		return $this->db_module;
	}

	public function
		get_table_name()
	{
		$adpe = $this->get_admin_db_page_element();

		$tes = $adpe->getElementsByTagName('table');

		if ($tes->length == 1) {
			$te = $tes->item(0);

			if ($te->hasAttribute('name')) {
				return $te->getAttribute('name');
			}
		}

		throw new Exception('Unable to find table name!');
	}

	public function
		get_table()
	{
		$muf = Database_MySQLUserFactory::get_instance();

		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();

		return $database->get_table($this->get_table_name());
	}

	public function
		get_admin_db_page_element()
	{
		$dd = $this->xml_file->get_dom_document();

		$adpes = $dd->getElementsByTagName('admin_db_page');

		if ($adpes->length == 1) {
			return $adpes->item(0);
		}

		throw new Exception('Unable to find admin db page element!');
	}

	public function
		get_pre_list_items()
	{
		$plis = array();

		$de = $this->get_display_node();

		$plises = $de->getElementsByTagName('pre_list_items');

		if ($plises->length == 1) {
			$plise = $plises->item(0);

			$plies = $plise->getElementsByTagName('pre_list_item');

			for ($i = 0; $i < $plies->length; $i++) {
				$plie = $plies->item($i);

				if ($plie->hasAttribute('name')) {
					$plis[$plie->getAttribute('name')] = $plie;
				}
			}
		}

		return $plis;
	}

	public function
		has_pre_list_items()
	{
		return count($this->get_pre_list_items() > 0);
	}

	public function
		get_display_node()
	{
		$adpe = $this->get_admin_db_page_element();

		$dns = $adpe->getElementsByTagName('display');

		if ($dns->length == 1) {
			return $dns->item(0);
		}

		throw new Exception('Unable to find display element!');
	}

	public function
		has_add_row_pre_list_link()
	{
		$plis = $this->get_pre_list_items();

		return in_array('add-new-row', array_keys($plis));
	}

	public function
		get_add_a_row_link_text()
	{
		$plis = $this->get_pre_list_items();

		if (isset($plis['add-new-row'])) {
			if ($plis['add-new-row']->hasAttribute('title')) {
				return $plis['add-new-row']->getAttribute('title');
			}
		}

		return 'Add a new row';
	}

	public function
		has_delete_all_rows_pre_list_link()
	{
		$plis = $this->get_pre_list_items();

		return in_array('delete-all', array_keys($plis));
	}

	public function
		get_delete_all_rows_link_text()
	{
		$plis = $this->get_pre_list_items();

		if (isset($plis['delete-all'])) {
			if ($plis['delete-all']->hasAttribute('title')) {
				return $plis['delete-all']->getAttribute('title');
			}
		}

		return 'Delete all rows';
	}

	private function
		get_selection_defaults()
	{
		$dn = $this->get_display_node();

		$sdes = $dn->getElementsByTagName('selection_defaults');

		$selection_defaults = array();

		if ($sdes->length == 1) {
			$sde = $sdes->item(0);

			if ($sde->hasAttribute('order_by')) {
				$selection_defaults['order_by'] = $sde->getAttribute('order_by');
			}

			if ($sde->hasAttribute('direction')) {
				$selection_defaults['direction'] = $sde->getAttribute('direction');
			}

			if ($sde->hasAttribute('offset')) {
				$selection_defaults['offset'] = $sde->getAttribute('offset');
			}

			if ($sde->hasAttribute('limit')) {
				$selection_defaults['limit'] = $sde->getAttribute('limit');
			}

			if ($sde->hasAttribute('available_limits')) {
				$selection_defaults['available_limits'] = $sde->getAttribute('available_limits');
			}

			if ($sde->hasAttribute('total_row_count_method_name')) {
				$selection_defaults['total_row_count_method_name'] = $sde->getAttribute('total_row_count_method_name');
			}

			if ($sde->hasAttribute('selection_method_name')) {
				$selection_defaults['selection_method_name'] = $sde->getAttribute('selection_method_name');
			}
		}

		return $selection_defaults;
	}

	public function
		get_current_limit()
	{
		if (!isset($this->current_limit)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['limit'])) {
				$this->current_limit = $sds['limit'];
			} else {
				$this->current_limit = 10;
			}
		}

		return $this->current_limit;
	}

	public function
		set_current_limit($current_limit)
	{
		$this->current_limit = $current_limit;
	}

	public function
		get_current_offset()
	{
		if (!isset($this->current_offset)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['offset'])) {
				$this->current_offset = $sds['offset'];
			} else {
				$this->current_offset = 0;
			}
		}

		return $this->current_offset;
	}

	public function
		set_current_offset($current_offset)
	{
		$this->current_offset = $current_offset;
	}

	public function
		get_current_order_by()
	{
		if (!isset($this->current_order_by)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['order_by'])) {
				$this->current_order_by = $sds['order_by'];
			} else {
				$this->current_order_by = 'id';
			}
		}

		return $this->current_order_by;
	}

	public function
		set_current_order_by($current_order_by)
	{
		$this->current_order_by = $current_order_by;
	}

	public function
		get_current_direction()
	{
		if (!isset($this->current_direction)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['direction'])) {
				$this->current_direction = $sds['direction'];
			} else {
				$this->current_direction = 'ASC';
			}
		}

		return $this->current_direction;
	}

	public function
		set_current_direction($current_direction)
	{
		$this->current_direction = $current_direction;
	}

	public function
		get_available_limits()
	{
		if (!isset($this->available_limits)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['available_limits'])) {
				$this->available_limits = $sds['available_limits'];
			} else {
				$this->available_limits = '10 20 50';
			}
		}

		return $this->available_limits;
	}

	public function
		get_total_row_count_method_name()
	{
		if (!isset($this->total_row_count_method_name)) {
			$sds = $this->get_selection_defaults();

			if (isset($sds['total_row_count_method_name'])) {
				$this->total_row_count_method_name = $sds['total_row_count_method_name'];
			} else {
				$this->total_row_count_method_name = 'count_all_rows';
			}
		}

		return $this->total_row_count_method_name;
	}

	public function
		get_total_row_count(Database_Table $table)
	{
		$trcmn = $this->get_total_row_count_method_name();

		$tro = new ReflectionObject($table);

		$trcm = $tro->getMethod($trcmn);

		return $trcm->invoke($table);
	}

	public function
		get_display_annotations()
	{
		$dn = $this->get_display_node();

		$daes = $dn->getElementsByTagName('annotations');

		$annotations = array();

		if ($daes->length == 1) {
			$dae = $daes->item(0);

			if ($dae->hasAttribute('rows_table_caption')) {
				$annotations['rows_table_caption'] = $dae->getAttribute('rows_table_caption');
			}
		}

		return $annotations;
	}

	public function
		get_rows_table_caption(
			 Database_Table $table
		)
	{
		$da = $this->get_display_annotations();

		if (isset($da['rows_table_caption'])) {
			return $da['rows_table_caption'];
		} else {
			return 'Rows from the ' . $table->get_name() . ' table.';
		}
	}

	public function
		append_column_headings_to_shtr(
			Database_SortableHeadingTR $shtr
		)
	{
		$dn = $this->get_display_node();

		$cses = $dn->getElementsByTagName('columns');

		if ($cses->length == 1) {
			$cse = $cses->item(0);

			$ces = $cse->getElementsByTagName('column');

			for ($i = 0; $i < $ces->length; $i++) {
				$ce = $ces->item($i);

				$sortable = TRUE;

				if ($ce->hasAttribute('sortable')) {
					if ($ce->getAttribute('sortable') == 'no') {
						$sortable = FALSE;
					}
				}

				if ($sortable) {
					$shtr->append_sortable_field_name($ce->getAttribute('name'));
				} else {
					$shtr->append_nonsortable_field_name($ce->getAttribute('name'));
				}
			}

			return $shtr;
		}

		throw new Exception('Unable to append columns to sortable heading TR!');
	}

	public function
		append_actions_to_shtr(
			Database_SortableHeadingTR $shtr
		)
	{
		$dn = $this->get_display_node();

		$ases = $dn->getElementsByTagName('actions');

		if ($ases->length == 1) {
			$ase = $ases->item(0);

			$aes = $ase->getElementsByTagName('action');

			for ($i = 0; $i < $aes->length; $i++) {
				$ae = $aes->item($i);
				$shtr->append_tag_to_content(
					Database_TableRenderer
						::get_action_th(
							$ae->getAttribute('name')
						)
					);
			}

			return $shtr;
		}

		throw new Exception('Unable to append actions to sortable heading TR!');
	}

	public function
		get_rows(
			Database_Table $table,
			$order_by,
			$direction,
			$offset,
			$limit
		)
	{
		$sds = $this->get_selection_defaults();

		if (isset($sds['selection_method_name'])) {
			$selection_method_name = $sds['selection_method_name'];
		} else {
			$selection_method_name = 'get_all_rows';
		}

		$tro = new ReflectionObject($table);

		$sm = $tro->getMethod($selection_method_name);

		return $sm->invoke($table, $order_by, $direction, $offset, $limit);
	}

	public function
		append_row_data_tds_to_tr(
			Database_Row $row,
			HTMLTags_TR $dtr
		)
	{
		$row_renderer = $row->get_renderer();

		$rrro = new ReflectionObject($row_renderer);

		$dn = $this->get_display_node();

		$cses = $dn->getElementsByTagName('columns');

		if ($cses->length == 1) {
			$cse = $cses->item(0);

			$ces = $cse->getElementsByTagName('column');

			for ($i = 0; $i < $ces->length; $i++) {
				$ce = $ces->item($i);

				if ($ce->hasAttribute('data_td_render_method')) {
					$dtrmn = $ce->getAttribute('data_td_render_method');
				} else {
					$dtrmn = 'get_data_html_table_td_str';
				}

				$dtrm = $rrro->getMethod($dtrmn);

				if ($dtrm->getNumberOfParameters() == 1) {
					$td = $dtrm->invoke($row_renderer, $ce->getAttribute('name'));
				} else {
					$td = $dtrm->invoke($row_renderer);
				}

				$dtr->append_tag_to_content($td);
			}

			return $dtr;
		}

		throw new Exception('Unable to append data to data TR!');
	}

	public function
		append_row_action_tds_to_tr(
			Database_Row $row,
			HTMLTags_TR $dtr
		)
	{
		$row_renderer = $row->get_renderer();

		$dn = $this->get_display_node();

		$ases = $dn->getElementsByTagName('actions');

		if ($ases->length == 1) {
			$ase = $ases->item(0);

			$aes = $ase->getElementsByTagName('action');

			for ($i = 0; $i < $aes->length; $i++) {
				$ae = $aes->item($i);

				if (
					$ae->getAttribute('name') == 'edit'
					||
					$ae->getAttribute('name') == 'delete'
				) {
					$td = new HTMLTags_TD();

					if ($ae->getAttribute('name') == 'edit') {
						if ($ae->hasAttribute('edit_link_text')) {
							$link = new HTMLTags_A(
								$this->getAttribute('edit_link_text')
							);
						} else {
							$link = new HTMLTags_A('Edit');
						}
					} elseif ($ae->getAttribute('name') == 'delete') {
						if ($ae->hasAttribute('delete_link_text')) {
							$link = new HTMLTags_A(
								$this->getAttribute('delete_link_text')
							);
						} else {
							$link = new HTMLTags_A('Delete');
						}
					}

					$link->set_attribute_str('class', 'cool_button');

					$location = $this->get_html_location();

					if ($ae->getAttribute('name') == 'edit') {
						$location->set_get_variable('edit_id', $row->get_id());
					} elseif ($ae->getAttribute('name') == 'delete') {
						$location->set_get_variable('delete_id', $row->get_id());
					}

					$link->set_href($location);

					$td->append_tag_to_content($link);

				} else {
					if ($ae->hasAttribute('td_render_method_name')) {
						$rmn = $ae->getAttribute('td_render_method_name');

						$rrro = new ReflectionObject($row_renderer);

						$rm = $rrro->getMethod($rmn);

						$td = $rm->invoke($row_renderer);
					} else {
						throw new Exception('No action TD render method set!');
					}
				}

				$dtr->append_tag_to_content($td);
			}

			return $dtr;
		}

		throw new Exception('Unable to append actions to data TR!');
	}

	public function
		get_html_location()
	{
		$l = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table-xml', 'html');

		$l->set_get_variable('db-section', $this->get_db_section());

		if ($this->has_db_module()) {
			$l->set_get_variable('db-module', $this->get_db_module());
		}

		$l->set_get_variable('db-xml-file', $this->get_xml_file_name_stem());

		return $l;
	}

	public function
		get_delete_all_rows_question()
	{
		return 'Delete all rows';
	}

	public function
		get_cancel_link_text()
	{
		return 'Cancel';
	}

	public function
		delete_all()
	{
		$table = $this->get_table();

		$table->delete_all();
	}

	public function
		get_all_rows_deleted_message()
	{
		return 'All rows deleted';
	}

	/*
	 * ----------------------------------------
	 * Functions to do with the row adding form.
	 * ----------------------------------------
	 */

	public function
		get_row_adding_form(
			Database_Table $table,
			HTMLTags_URL $action_href,
			HTMLTags_URL $cancel_href
		)
	{
		$form = new HTMLTags_SimpleOLForm($this->get_row_adding_form_name());

		$svm = Caching_SessionVarManager::get_instance();

		$form->set_legend_text($this->get_row_adding_form_legend_text());

		$form->set_action($action_href);

		$form->set_cancel_location($cancel_href);

		$form->set_cancel_text($this->get_cancel_link_text());

		$field_names = $this->get_row_adding_form_field_names();

#		print_r($field_names); exit;

		foreach ($field_names as $field_name) {
#			echo $field_name; exit;

			$input = $this->get_row_adding_form_field_input($field_name);

#			if ($svm->is_set("table-xml: $field_name")) {
#				$current_value = $svm->get("table-xml: $field_name");
#
#
#			} else {
#
#			}

			$form->add_input_tag(
				$field_name,
				$input,
				($this->has_row_adding_form_field_label_text($field_name)
					? $this->get_row_adding_form_field_label_text($field_name)
					: NULL
				)
			);
		}

		$form->set_submit_text($this->get_row_adding_form_submit_text());

		return $form;
	}

	public function
		get_row_adding_form_name()
	{
		return 'row_adding';
	}

	public function
		get_row_adding_form_legend_text()
	{
		return 'Add a row';
	}

	private function
		get_adding_element()
	{
		$dd = $this->xml_file->get_dom_document();

		$adding_elements = $dd->getElementsByTagName('adding');

		if ($adding_elements->length == 1) {
			$adding_element = $adding_elements->item(0);

			return $adding_element;
		}

		throw new Exception('No adding element found!');
	}

	private function
		get_row_adding_form_fields_data()
	{
		$data = array();

		$dd = $this->xml_file->get_dom_document();

		$adding_elements = $dd->getElementsByTagName('adding');

		if ($adding_elements->length == 1) {
			$adding_element = $adding_elements->item(0);

			$fields_elements = $adding_element->getElementsByTagName('fields');

			if ($fields_elements->length == 1) {
				$fields_element = $fields_elements->item(0);

				$field_elements = $fields_element->getElementsByTagName('field');

				for ($i = 0; $i < $field_elements->length; $i++) {
					$field_data = array();

					$field_element = $field_elements->item($i);

					$field_data['name'] = $field_element->getAttribute('name');

					$field_data['required'] =
						$field_element->hasAttribute('required')
						&&
						(strtolower($field_element->getAttribute('required')) == 'yes');

					$field_data['title'] =
						$field_element->hasAttribute('title')
						? $field_element->getAttribute('title')
						: NULL;

#					print_r($field_data); exit;

					$data[] = $field_data;
				}
			}
		}

#		print_r($data); exit;

		return $data;
	}

	public function
		get_row_adding_form_field_names()
	{
		$names = array();

		$data = $this->get_row_adding_form_fields_data();

#		print_r($data);

		foreach($data as $field_data) {
			$names[] = $field_data['name'];
		}

#		print_r($names); exit;

		if (count($names) == 0) {
			$table = $this->get_table();

			$fields = $table->get_fields();

			foreach ($fields as $field) {
				if ($field->get_name() != 'id') {
					$names[] = $field->get_name();
				}
			}
		}

		return $names;
	}

	public function
		get_row_adding_form_field_input($name)
	{
		$table = $this->get_table();

		$field = $table->get_field($name);

		$field_renderer = $field->get_renderer();

		$input = $field_renderer->get_form_input();

		return $input;
	}

	public function
		has_row_adding_form_field_label_text($name)
	{
		$data = $this->get_row_adding_form_fields_data();

		return isset($data[$name]['title']);
	}

	public function
		get_row_adding_form_field_label_text($name)
	{
		$data = $this->get_row_adding_form_fields_data();

		return $data[$name]['title'];
	}

	public function
		get_row_adding_form_submit_text()
	{
		return 'Add';
	}

	/*
	 * ----------------------------------------
	 * Functions to do with adding values to the DB
	 * ----------------------------------------
	 */

	public function
		add(
			Database_Table $table,
			$post_array,
			$files_array
		)
	{
#		echo get_class($table) . "\n";
#		print_r($post_array);
#		print_r($files_array);

		/*
		 * Find the fields to add.
		 */
		$values = array();

		foreach ($this->get_row_adding_form_fields_data() as $field_data) {
			if (isset($post_array[$field_data['name']])) {
				$values[$field_data['name']] = $post_array[$field_data['name']];
			}
		}

#		print_r($values); exit;

		$tro = new ReflectionObject($table);

		if ($tro->hasMethod($this->get_row_adding_db_method_name())) {
			$adrm = $tro->getMethod($this->get_row_adding_db_method_name());

			return $adrm->invoke($table, $values);
		} else {
			throw new Exception('No method called ' . $this->get_row_adding_db_method_name() . ' in ' . get_class($table) . '!');
		}

		#exit;
	}

	public function
		get_row_adding_db_method_name()
	{
		$adding_element = $this->get_adding_element();

		$db_method_elements = $adding_element->getElementsByTagName('db_method');

		if ($db_method_elements->length == 1) {
			$db_method_element = $db_method_elements->item(0);

			if ($db_method_element->hasAttribute('name')) {
				return $db_method_element->getAttribute('name');
			}
		}

		return 'add';
	}

	public function
		get_last_added_message(
			Database_Table $table,
			$row_id
		)
	{
		return "Added row $row_id.";
	}

	/*
	 * ----------------------------------------
	 * Functions to do with deleting a row.
	 * ----------------------------------------
	 */

	private function
		get_deleting_element()
	{
		$dd = $this->xml_file->get_dom_document();

		$deleting_elements = $dd->getElementsByTagName('deleting');

		if ($deleting_elements->length == 1) {
			$deleting_element = $deleting_elements->item(0);

			return $deleting_element;
		}

		throw new Exception('No adding element found!');
	}

	public function
		get_delete_row_question()
	{
		return 'Are you sure you want to delete this row?';
	}

	public function
		get_delete_row_render_div(Database_Row $row)
	{
		$row_renderer = $row->get_renderer();

		$sxe = $this->get_simple_xml_element();

		#echo 'print_r($sxe)' . "\n"; print_r($sxe);
		#
		#$rmn = $sxe->deleting->render_method['name'];
		#echo 'echo($rmn)' . "\n"; echo($rmn);exit;

		if (isset($sxe->deleting->render_method['name'])) {
			$rmn = $sxe->deleting->render_method['name'];

			#echo "$rmn\n"; exit;
			$rrro = new ReflectionObject($row_renderer);

			if ($rrro->hasMethod($rmn)) {
				$drrdm = $rrro->getMethod($rmn);

				return $drrdm->invoke($row_renderer);
			} else {
				throw new Exception('No method called ' . $this->get_row_adding_db_method_name() . ' in ' . get_class($table) . '!');
			}
		} else {
			return $row_renderer->get_all_data_html_table();
		}
	}

	public function
		get_delete_row_link_text()
	{
		return 'DELETE';
	}

	public function
		delete_by_id(
			Database_Table $table,
			$id
		)
	{
		$table->delete_by_id($id);
	}

	public function
		get_last_deleted_message(
			Database_Table $table,
			$id
		)
	{
		return 'Deleted row ' . $id . ' from the ' . $table->get_name() . ' table.';
	}

	/*
	 * ----------------------------------------
	 * Functions to do with the row editing form
	 * ----------------------------------------
	 */

	public function
		get_row_editing_form(
			Database_Row $row,
			HTMLTags_URL $action_url,
			HTMLTags_URL $cancel_url
		)
	{
		$form = new HTMLTags_SimpleOLForm(
			$this->get_row_editing_form_name($row)
		);

		$form->set_action($action_url);

		$form->set_legend_text($this->get_legend_text($row));

		$form->set_cancel_text($this->get_cancel_link_text());

		$form->set_cancel_location($cancel_url);

		$form->set_submit_text($this->get_row_editing_form_submit_text());

		$field_names = $this->get_row_editing_form_field_names();

		foreach ($field_names as $field_name) {
			$input = $this->get_row_editing_form_field_input($row, $field_name);

			$form->add_input_tag(
				$field_name,
				$input,
				($this->has_row_editing_form_field_label_text($field_name)
					? $this->get_row_editing_form_field_label_text($field_name)
					: NULL
				)
			);
		}

		return $form;
	}

	public function
		get_row_editing_form_name(
			Database_Row $row
		)
	{
		$table = $row->get_table();

		$name = $table->get_name();

		return 'editing_' . $name;
	}

	public function
		get_legend_text(
			Database_Row $row
		)
	{
		$table = $row->get_table();

		$name = $table->get_name();

		return 'Edit row ' . $row->get_id() . ' in the ' . $name . ' table';
	}

	private function
		get_row_editing_form_fields_data()
	{
		$data = array();

		$dd = $this->xml_file->get_dom_document();

		$editing_elements = $dd->getElementsByTagName('editing');

		if ($editing_elements->length == 1) {
			$editing_element = $editing_elements->item(0);

			$fields_elements = $editing_element->getElementsByTagName('fields');

			if ($fields_elements->length == 1) {
				$fields_element = $fields_elements->item(0);

				$field_elements = $fields_element->getElementsByTagName('field');

				for ($i = 0; $i < $field_elements->length; $i++) {
					$field_data = array();

					$field_element = $field_elements->item($i);

					$field_data['name'] = $field_element->getAttribute('name');

					$field_data['required'] =
						$field_element->hasAttribute('required')
						&&
						(strtolower($field_element->getAttribute('required')) == 'yes');

					$field_data['title'] =
						$field_element->hasAttribute('title')
						? $field_element->getAttribute('title')
						: NULL;

#					print_r($field_data); exit;

					$data[] = $field_data;
				}
			}
		} else {
			/*
			 * If there's no editing data, use the adding data.
			 */
			$data = $this->get_row_adding_form_fields_data();
		}

#		print_r($data); exit;

		return $data;
	}

	public function
		get_row_editing_form_field_names()
	{
		$names = array();

		$data = $this->get_row_editing_form_fields_data();

#		print_r($data);

		foreach($data as $field_data) {
			$names[] = $field_data['name'];
		}

#		print_r($names); exit;

		if (count($names) == 0) {
			$table = $this->get_table();

			$fields = $table->get_fields();

			foreach ($fields as $field) {
				if ($field->get_name() != 'id') {
					$names[] = $field->get_name();
				}
			}
		}

		return $names;
	}

	public function
		get_row_editing_form_field_input(
			Database_Row $row,
			$name
		)
	{
		$table = $row->get_table();

		$field = $table->get_field($name);

		$field_renderer = $field->get_renderer();

		$input = $field_renderer->get_form_input();

		$input->set_value($row->get($name));

		return $input;
	}

	public function
		has_row_editing_form_field_label_text($name)
	{
		$data = $this->get_row_editing_form_fields_data();

		return isset($data[$name]['title']);
	}

	public function
		get_row_editing_form_field_label_text($name)
	{
		$data = $this->get_row_editing_form_fields_data();

		return $data[$name]['title'];
	}

	public function
		get_row_editing_form_submit_text()
	{
		return 'Update';
	}

	/*
	 * ----------------------------------------
	 * Functions to do with updating the DB.
	 * ----------------------------------------
	 */
	public function
		update_by_id(
			$table,
			$edit_id,
			$post_arr,
			$files_arr
		)
	{
		$values = array();

		foreach ($this->get_row_editing_form_field_names() as $n) {
			$values[$n] = $post_arr[$n];
		}

		return $table->update_by_id($edit_id, $values);
	}

	public function
		get_last_edited_message(
			Database_Table $table,
			$id
		)
	{
		return 'Updated row ' . $id . ' from the ' . $table->get_name() . ' table.';
	}
}
?>
