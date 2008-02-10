<?php
class
	Navigation_ManageNodesAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Navigation_NodesCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'tree_title'
			),
			array(
				'col_name' => 'url_title'
			),
			array(
				'col_name' => 'sort_order'
			),
			array(
				'col_name' => 'added'
			)
	 	);
	}
	
	protected function
		get_matching_query_select_clause()
	{
		return <<<SQL
SELECT
	hpi_navigation_nodes.id AS id,
	hpi_navigation_nodes.sort_order AS sort_order,
	hpi_navigation_nodes.added AS added,
	hpi_navigation_urls.title AS url_title,
	hpi_navigation_trees.title AS tree_title
	
	
SQL;

	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_navigation_nodes
		INNER JOIN hpi_navigation_urls ON
			hpi_navigation_nodes.url_id = hpi_navigation_urls.id
		INNER JOIN hpi_navigation_trees ON
			hpi_navigation_nodes.tree_id = hpi_navigation_trees.id
			
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		/*
		 * Choose the tree.
		 */
?>
<li>
				
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, title
FROM
	hpi_navigation_trees
ORDER BY
	title
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
	<label for="tree_id">Tree</label>
	<select
		name="tree_id"
	>
	<?php while ($row = mysql_fetch_assoc($result)):  ?>
		<option value="<?php echo $row['id']; ?>" <?php if ($acm->has_form_session_var('tree_id') && ($acm->get_form_session_var('tree_id') == $row['id'])) { echo ' selected="selected"'; } ?>><?php echo $row['title']; ?></option>
	<?php endwhile; ?>
	</select>
<?php
} else {
?>
<p class="error">No trees available!</p>
<?php
}
?>
</li>
<?php

		/*
		 * Choose the url.
		 */
?>
<li>
				
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, title
FROM
	hpi_navigation_urls
ORDER BY
	title
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
	$urls = array();
	
	#$urls[] = array(
	#	'id' => 0,
	#	'title' => 'No URL'
	#);
	
	while ($row = mysql_fetch_assoc($result)) {
		$urls[] = $row;
	}
	
?>
	<label for="url_id">URL</label>
	<select
		name="url_id"
	>
	<?php foreach ($urls as $url):  ?>
		<option value="<?php echo $url['id']; ?>" <?php if ($acm->has_form_session_var('url_id') && ($acm->get_form_session_var('url_id') == $url['id'])) { echo ' selected="selected"'; } ?>><?php echo $url['title']; ?></option>
	<?php endforeach; ?>
	</select>
<?php
} else {
?>
<p class="error">No urls available!</p>
<?php
}
?>
</li>
<?php

		/*
		 * Set the sort order.
		 */
		$this->render_add_something_form_li_text_input('sort_order');
		
		/*
		 * Say whether the link should open in a new window or not.
		 */
?>
<li>
	<label for="open_in_new_window">Open in New Window</label>
	<select
		name="open_in_new_window"
	>
	<?php foreach (explode(' ', 'No Yes') as $choice):  ?>
		<option value="<?php echo $choice; ?>" <?php if ($acm->has_form_session_var('open_in_new_window') && ($acm->get_form_session_var('open_in_new_window') == $choice)) { echo ' selected="selected"'; } ?>><?php echo $choice; ?></option>
	<?php endforeach; ?>
	</select>
</li>
<?php
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		/*
		 * Choose the tree.
		 */
?>
<li>
				
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, title
FROM
	hpi_navigation_trees
ORDER BY
	title
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
	<label for="tree_id">Tree</label>
	<select
		name="tree_id"
	>
	<?php while ($row = mysql_fetch_assoc($result)):  ?>
		<option value="<?php echo $row['id']; ?>" <?php if ($acm->has_current_var('tree_id') && ($acm->get_current_var('tree_id') == $row['id'])) { echo ' selected="selected"'; } ?>><?php echo $row['title']; ?></option>
	<?php endwhile; ?>
	</select>
<?php
} else {
?>
<p class="error">No trees available!</p>
<?php
}
?>
</li>
<?php

		/*
		 * Choose the url.
		 */
?>
<li>
				
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id, title
FROM
	hpi_navigation_urls
ORDER BY
	title
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
	$urls = array();
	
	#$urls[] = array(
	#	'id' => 0,
	#	'title' => 'No URL'
	#);
	
	while ($row = mysql_fetch_assoc($result)) {
		$urls[] = $row;
	}
	
?>
	<label for="url_id">URL</label>
	<select
		name="url_id"
	>
	<?php foreach ($urls as $url):  ?>
		<option value="<?php echo $url['id']; ?>" <?php if ($acm->has_current_var('url_id') && ($acm->get_current_var('url_id') == $url['id'])) { echo ' selected="selected"'; } ?>><?php echo $url['title']; ?></option>
	<?php endforeach; ?>
	</select>
<?php
} else {
?>
<p class="error">No urls available!</p>
<?php
}
?>
</li>
<?php

		$this->render_edit_something_form_li_text_input('sort_order');
		
		/*
		 * Say whether the link should open in a new window or not.
		 */
?>
<li>
	<label for="open_in_new_window">Open in New Window</label>
	<select
		name="open_in_new_window"
	>
	<?php foreach (explode(' ', 'No Yes') as $choice):  ?>
		<option value="<?php echo $choice; ?>" <?php if ($acm->has_current_var('open_in_new_window') && ($acm->get_current_var('open_in_new_window') == $choice)) { echo ' selected="selected"'; } ?>><?php echo $choice; ?></option>
	<?php endforeach; ?>
	</select>
</li>
<?php

		/*
		 * Set the parent node.
		 */
		if ($acm->has_current_var('tree_id')) {
?>
<li>
<?php
	
			$dbh = DB::m();
			
			$tree_id = $acm->get_current_var('tree_id');
			
			$query = <<<SQL
SELECT
	hpi_navigation_nodes.id AS id,
	title
FROM
	hpi_navigation_nodes
		INNER JOIN hpi_navigation_urls ON
			hpi_navigation_nodes.url_id = hpi_navigation_urls.id
WHERE
	hpi_navigation_nodes.tree_id = $tree_id
ORDER BY
	hpi_navigation_urls.title ASC
SQL;

			$result = mysql_query($query, $dbh);
			
			if (
				$result
				&&
				(mysql_num_rows($result) > 0)
			) {
				$possible_parents = array();
				
				$possible_parents[] = array(
					'id' => 0,
					'title' => 'No parent (root)'
				);
				
				while ($row = mysql_fetch_assoc($result)) {
					$possible_parents[] = $row;
				}
	
?>
	<label for="parent_id">Parent</label>
	<select
		name="parent_id"
	>
	<?php foreach ($possible_parents as $possible_parent):  ?>
		<option value="<?php echo $possible_parent['id']; ?>" <?php if ($acm->has_current_var('parent_id') && ($acm->get_current_var('parent_id') == $possible_parent['id'])) { echo ' selected="selected"'; } ?>><?php echo $possible_parent['title']; ?></option>
	<?php endforeach; ?>
	</select>
<?php
} else {
?>
<p class="error">No possible parents available!</p>
<?php
}
?>
</li>
<?php
		}
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add a Node';
	}
	
	protected function
		get_default_order_by()
	{
		return 'tree_title';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage Nodes';
	}
}
?>