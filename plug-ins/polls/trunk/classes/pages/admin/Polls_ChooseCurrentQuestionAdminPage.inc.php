<?php
class
	Polls_ChooseCurrentQuestionAdminPage
extends
	Admin_RestrictedHTMLPage
{
	public function
		content()
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	*
FROM
	hpi_polls_questions
ORDER BY
	question ASC
SQL;

		$result = mysql_query($query, $dbh);
		
		$questions = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$questions[] = $row;
		}

?>
<table>
	<caption>Questions</caption>
	<thead>
		<tr>
			<th>Question</th>
			<th>Current</th>
			<th>Make Current</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach ($questions as $question):
			echo "<tr>\n";
			
			echo "<td>\n";
			echo stripcslashes($question['question']);
			echo "</td>\n";
			
			echo "<td>\n";
			echo $question['current'];
			echo "</td>\n";
			
			echo "<td>\n";
			
			if ($question['current'] == 'Yes') {
				echo '&nbsp;';
			} else {
				echo '<a ';
				$return_to = $this->get_current_base_url();
				
				$return_to = urlencode($return_to->get_as_string());
				
				echo ' href="/haddock/public-html/public-html/index.php?oo-page=1&page-class=Polls_ChooseCurrentQuestionAdminRedirectScript&question_id=' . $question['id'] . '&return_to=' . $return_to . '" ';
				echo '>';
				
				echo "Do it";
				
				echo "</a>\n";
			}
			
			echo "</td>\n";
			
			echo "</tr>\n";			
		endforeach;
?>
	</tbody>
</table>
<?php
	}
}
?>