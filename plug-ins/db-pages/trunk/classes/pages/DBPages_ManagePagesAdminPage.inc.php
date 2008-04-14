<?php
/**
 * DBPages_ManagePagesAdminPage
 *
 * @copyright 2007-12-16, RFI
 */

class
	DBPages_ManagePagesAdminPage
extends
	Database_CRUDAdminPage
{
	/*
	 * ----------------------------------------
	 * Functions to do with titles.
	 * ----------------------------------------
	 */
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage Page Content';
	}

	protected function
		get_data_table_caption_content_explanation_part()
	{
		return 'DB Pages';
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add section to page';
	}
	
	protected function
		get_edit_something_title()
	{
		return 'Edit section of page';
	}
	
	protected function
		get_delete_everything_title()
	{
		return 'Delete all DB Pages';
	}

	/*
	 * ----------------------------------------
	 * Functions to do with displaying data in the HTML table.
	 * ----------------------------------------
	 */
	
	protected function
		get_default_order_by()
	{
		return 'page';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'page'
			),
			array(
				'col_name' => 'section'
			),
			array(
				'col_name' => 'modified',
				'filter' => '$t = strtotime($str); return date(\'D, jS M Y\', $t);'
			),
			array(
				'col_name' => 'text',
				'sortable' => 'no',
				'filter' => '$str = stripcslashes($str); $str = substr($str, 0, 50); $str = htmlentities($str); $str .= \'...\'; return $str;'
			)
		);
	}
	
	#protected function
	#	get_data_table_actions()
	#{
	#	$actions = parent::get_data_table_actions();
	#	
	#	$eval_template = $this->get_data_table_actions_content_eval_template();
	#	
	#	$actions[] = array(
	#		'name' => 'purge',
	#		'filter' => sprintf($eval_template, 'purge_something')
	#	);
	#	
	#	#print_r($actions);
	#	#exit;
	#	
	#	return $actions;
	#}
	
	/*
	 * ----------------------------------------
	 * Functions to do with building SQL queries.
	 * ----------------------------------------
	 */
	
	protected function
		get_matching_query_select_clause()
	{
		return <<<SQL
SELECT
	hpi_db_pages_pages.id AS id,
	hpi_db_pages_pages.name AS page,
	hpi_db_pages_sections.name AS section,
	hpi_db_pages_texts.text AS text,
	hpi_db_pages_filter_functions.name AS filter_function,
	hpi_db_pages_edits.submitted AS modified

SQL;

	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_db_pages_pages
		INNER JOIN hpi_db_pages_edits ON
			hpi_db_pages_pages.id = hpi_db_pages_edits.page_id
		INNER JOIN hpi_db_pages_texts ON
			hpi_db_pages_edits.text_id = hpi_db_pages_texts.id
		INNER JOIN hpi_db_pages_text_section_links ON
			hpi_db_pages_texts.id = hpi_db_pages_text_section_links.text_id
		INNER JOIN hpi_db_pages_sections ON
			hpi_db_pages_text_section_links.section_id = hpi_db_pages_sections.id
		LEFT JOIN hpi_db_pages_filter_functions ON
			hpi_db_pages_texts.filter_function_id
			=
			hpi_db_pages_filter_functions.id

SQL;

	}
	
	protected function
		get_matching_query_where_clause()
	{
		return <<<SQL
WHERE
	hpi_db_pages_edits.deleted = 'No'
	AND
	hpi_db_pages_edits.current = 'Yes'
	
SQL;

	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with rendering the form that allows the user
	 * to add stuff to the database.
	 * ----------------------------------------
	 */
	
	#protected function
	#	get_redirect_script_class_name()
	#{
	#	return 'DBPages_ManagePagesAdminRedirectScript';
	#}
	
	protected function
		render_add_something_form()
	{
		$add_rsu = $this->get_add_something_redirect_script_url();
		$clear_rsu = $this->get_clear_form_redirect_script_url();
		
		#echo 'print_r($_SESSION): '; print_r($_SESSION); exit;
		#
		#$sa = $this->get_session_array();
		#
		#echo 'print_r($sa): '; print_r($sa); exit;
		
		$acm = $this->get_admin_crud_manager();
		
?>
<form
	name="add_new_db_page_form"
	id="basic-form"
	class="basic-form"
	method="POST"
	action="<?php echo $add_rsu->get_as_string(); ?>"
>
	<fieldset>
		<legend><?php echo $this->get_add_something_title(); ?></legend>
		<ol>
			<li>
				<label for="page">Page</label>
				<input
					type="text"
					name="page"
					id="page"
					value="<?php
					if ($acm->has_form_session_var('page')) {
						echo $acm->get_form_session_var('page');
					} else {
						if (isset($_GET['page'])) {
							echo urldecode($_GET['page']);
						}
					}
					?>"
				/>
				<span id="pagemsg" class="rules"></span>
			</li>
			<li>
				<label for="section">Section</label>
				<input
					type="text"
					name="section"
					id="section"
					value="<?php
					if ($acm->has_form_session_var('section')) {
						echo $acm->get_form_session_var('section');
					} else {
						if (isset($_GET['section'])) {
							echo urldecode($_GET['section']);
						}
					}
					?>"
				/>
				<span id="sectionmsg" class="rules"></span>
			</li>
			<li>
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, human_name
FROM
	hpi_db_pages_filter_functions
ORDER BY
	human_name
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
				<label for="filter_function">Filter Function</label>
				<select
					name="filter_function"
				>
				<?php while ($row = mysql_fetch_assoc($result)):  ?>
					<option value="<?php echo $row['id']; ?>" <?php if ($acm->has_form_session_var('filter_function') && ($acm->get_form_session_var('filter_function') == $row['id'])) { echo ' selected="selected"'; } ?>><?php echo $row['human_name']; ?></option>
				<?php endwhile; ?>
				</select>
<?php
} else {
?>
<p class="error">No filter functions available!</p>
<?php
}
?>
			</li>
			<li>
				<label for="text">Text</label>
				<textarea
					name="text"
					id="text"
					cols="50"
					rows="20"
				><?php
if ($acm->has_form_session_var('text')) {
	$text = $acm->get_form_session_var('text');
	
	$text = stripcslashes($text);
	
	echo $text;
}
?></textarea>
				<span id="textmsg" class="rules"></span>
			</li>
		</ol>
	</fieldset>
	<div class="submit_buttons_div">
		<input
			type="submit"
			value="Add"
			class="submit"
		/>
		<input
			type="button"
			value="Cancel"
			onclick="document.location.href=('<?php echo $clear_rsu->get_as_string(); ?>')"
			class="submit"
		/>
	</div>
</form>
<?php
	}
	
	protected function
		render_edit_something_form()
	{
		$edit_rsu = $this->get_edit_something_redirect_script_url();
		$clear_rsu = $this->get_clear_form_redirect_script_url();
		
		#echo 'print_r($_SESSION): '; print_r($_SESSION); exit;
		#
		#$sa = $this->get_session_array();
		#
		#echo 'print_r($sa): '; print_r($sa); exit;
		
		$acm = $this->get_admin_crud_manager();
		
?>
<form
	name="edit_db_page_form"
	id="basic-form"
	class="basic-form"
	method="POST"
	action="<?php echo $edit_rsu->get_as_string(); ?>"
>
	<fieldset>
		<legend><?php echo $this->get_edit_something_title(); ?></legend>
		<ol>
			<li>
				Page:&nbsp;
				<?php echo $acm->get_current_var('page'); ?>
			</li>
			<li>
				Section:&nbsp;
				<?php echo $acm->get_current_var('section'); ?>
			</li>
			<li>
				
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, human_name
FROM
	hpi_db_pages_filter_functions
ORDER BY
	human_name
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
				<label for="filter_function">Filter Function</label>
				<select
					name="filter_function"
				>
				<?php while ($row = mysql_fetch_assoc($result)):  ?>
					<option value="<?php echo $row['id']; ?>" <?php
					#print_r($acm);
					#exit;
					
					#print_r($row); exit;
					
					if (
						$acm->has_current_var('filter_function_id')
						&&
						($acm->get_current_var('filter_function_id') == $row['id'])
					) {
						echo ' selected="selected"';
					} ?>><?php echo $row['human_name']; ?></option>
				<?php endwhile; ?>
				</select>
<?php
} else {
?>
<p class="error">No filter functions available!</p>
<?php
}
?>
			</li>
			<li>
				<label for="text">Text</label>
				<textarea
					name="text"
					id="text"
					cols="50"
					rows="20"
				><?php
if ($acm->has_current_var('text')) {
	$text = $acm->get_current_var('text');
	
	$text = stripcslashes($text);
	
	echo $text;
}
?></textarea>
				<span id="textmsg" class="rules"></span>
			</li>
		</ol>
	</fieldset>
	<div class="submit_buttons_div">
		<input
			type="submit"
			value="Edit"
			class="submit"
		/>
		<input
			type="button"
			value="Cancel"
			onclick="document.location.href=('<?php echo $clear_rsu->get_as_string(); ?>')"
			class="submit"
		/>
	</div>
</form>
<?php
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'DBPages_CRUDAdminManager';
	}
	
	/**
	 * The rows to be edited are not identified by the id key.
	 *
	 * They are identified by the page and the section.
	 *
	 * This really can't be the most sensible way of doing this.
	 *
	 * I guess that I was right to call it barking mad the other day.
	 * 
	 * It works, however.
	 *
	 * There should probably be a function that just returns the
	 * array of columns for the key.
	 */
	#protected function
	#	get_data_table_actions_content_eval_template()
	#{
	#	return 'return $this->make_content_for_action_td_for_item($action[\'name\'], \'%s\', array(\'page\' => $row[\'name\'], \'section\' => $row[\'section\']));';
	#}
	
	protected function
		get_confirm_deleting_everything_question_object()
	{
		return 'all the pages';
	}
}
?>