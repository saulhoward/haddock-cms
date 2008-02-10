<?php
class
	Polls_ManageAnswersAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Polls_AnswersCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'question_id'
			),
			array(
				'col_name' => 'answer',
				'filter' => '$str = stripcslashes($str); if (strlen($str) > 50) { $str = substr($str, 0, 50); $str .= \'...\'; } return $str;'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_polls_answers
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
?>
			<li>
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id,
	question
FROM
	hpi_polls_questions
ORDER BY
	question ASC
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
				<label for="question_id">Question</label>
				<select
					name="question_id"
				>
				<?php while ($row = mysql_fetch_assoc($result)):  ?>
					<option value="<?php echo $row['id']; ?>" <?php
					if (
						$acm->has_form_session_var('question_id')
						&& ($acm->get_form_session_var('question_id') == $row['id'])
					) {
						echo ' selected="selected"';
					}
					?>><?php echo stripcslashes($row['question']); ?></option>
				<?php endwhile; ?>
				</select>
<?php
} else {
?>
<p class="error">No questions available!</p>
<?php
}
?>
			</li>
<?php

		$this->render_add_something_form_li_text_input('answer');
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";

?>
			<li>
<?php
$dbh = DB::m();

$query = <<<SQL
SELECT
	id,
	question
FROM
	hpi_polls_questions
ORDER BY
	question ASC
SQL;

$result = mysql_query($query, $dbh);

if (
	$result
	&&
	(mysql_num_rows($result) > 0)
) {
?>
				<label for="question_id">Question</label>
				<select
					name="question_id"
				>
				<?php while ($row = mysql_fetch_assoc($result)):  ?>
					<option value="<?php echo $row['id']; ?>" <?php
					if (
						$acm->has_current_var('question_id')
						&& ($acm->get_current_var('question_id') == $row['id'])
					) {
						echo ' selected="selected"';
					}
					?>><?php echo stripcslashes($row['question']); ?></option>
				<?php endwhile; ?>
				</select>
<?php
} else {
?>
<p class="error">No questions available!</p>
<?php
}
?>
			</li>
<?php

		$this->render_edit_something_form_li_text_input('answer');
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add an Answer';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage Answers';
	}
}
?>