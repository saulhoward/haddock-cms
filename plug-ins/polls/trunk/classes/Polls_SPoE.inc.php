<?php
class
	Polls_SPoE
{
	public static function
		render_public_polls_table()
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	hpi_polls_questions.question,
	hpi_polls_questions.id AS question_id,
	hpi_polls_answers.answer,
	COUNT(hpi_polls_votes.id) AS vote_count
FROM
	hpi_polls_questions
		INNER JOIN hpi_polls_answers ON
			hpi_polls_questions.id = hpi_polls_answers.question_id
		LEFT JOIN hpi_polls_votes ON
			hpi_polls_answers.id = hpi_polls_votes.answer_id
GROUP BY
	hpi_polls_votes.answer_id
ORDER BY
	question_id DESC,
	answer ASC	
SQL;

		$result = mysql_query($query, $dbh);
		
		$vote_counts = array();
		$total_votes = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$vote_counts[] = $row;
			$total_votes[$row['question_id']] += $row['vote_count'];
		}
		
		#print_r($vote_counts);
		
?>
<table>
	<caption>Recent Polls</caption>
	<thead>
		<tr>
			<th>Question</th>
			<th>Answers</th>
			<th>Percentage</th>
		</tr>
	</thead>
	<tbody>
<?php
		$previous_question_id = 0;
		foreach ($vote_counts as $vote_count):
			echo "<tr>\n";
			
			echo "<td>\n";
			
			if ($previous_question_id == $vote_count['question_id']) {
				echo '&nbsp;';
			} else {
				$previous_question_id = $vote_count['question_id'];
				
				echo stripcslashes($vote_count['question']);
			}
			
			echo "</td>\n";
			
			echo "<td>\n";
			echo stripcslashes($vote_count['answer']);
			echo "</td>\n";
			
			echo "<td>\n";
			
			if ($vote_count['vote_count']) {
				printf("%.1f\n", (($vote_count['vote_count'] / $total_votes[$vote_count['question_id']]) * 100));
			} else {
				echo '0.0';
			}
			echo "</td>\n";
			
			echo "</tr>\n";
		endforeach;
?>
	</tbody>
</table>
<?php
	}
	
	public static function
		render_current_question_table(
			HTMLTags_URL $voting_script_url
		)
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	hpi_polls_questions.question AS question,
	hpi_polls_questions.id AS question_id,
	hpi_polls_answers.answer AS answer,
	hpi_polls_answers.id AS answer_id
FROM
	hpi_polls_questions
		INNER JOIN hpi_polls_answers ON
			hpi_polls_questions.id = hpi_polls_answers.question_id
WHERE
	hpi_polls_questions.current = 'Yes'
ORDER BY
	hpi_polls_answers.answer ASC
SQL;
		
		$result = mysql_query($query, $dbh);
		
		$first = TRUE;
		$question = '';
		$question_id = 0;
		$answers = array();
		
		while ($row = mysql_fetch_array($result)) {
			if ($first) {
				$question = stripcslashes($row['question']);
				$question_id = $row['question_id'];
				
				$first = FALSE;
			}
			
			$answers[] = $row;
		}
		
?>
<div id="poll_question_and_answers">
	<p id="poll_question"><?php echo $question; ?></p>
	<ul id="poll_answers">
<?php
		foreach ($answers as $answer):
			echo "<li>\n";
			
			echo '<a ';
			
			$vote_for_this_url = clone $voting_script_url;
			$vote_for_this_url->set_get_variable('answer_id', $answer['answer_id']);
			
			echo ' href="' . $vote_for_this_url->get_as_string() . '" ';
			
			echo '>';
			
			echo stripcslashes($answer['answer']);
			
			echo "</a>\n";
			
			echo "</li>\n";
		endforeach;
?>
	</ul>
</div>
<?php
	}
	
	public static function
		render_current_poll_results_table()
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	hpi_polls_answers.answer,
	COUNT(hpi_polls_votes.id) AS vote_count
FROM
	hpi_polls_questions
		INNER JOIN hpi_polls_answers ON
			hpi_polls_questions.id = hpi_polls_answers.question_id
		LEFT JOIN hpi_polls_votes ON
			hpi_polls_answers.id = hpi_polls_votes.answer_id
WHERE
	hpi_polls_questions.current = 'Yes'
GROUP BY
	hpi_polls_votes.answer_id
ORDER BY
	answer ASC	
SQL;

		$result = mysql_query($query, $dbh);
		
		$vote_counts = array();
		$total_votes = 0;
		
		while ($row = mysql_fetch_assoc($result)) {
			$vote_counts[] = $row;
			$total_votes += $row['vote_count'];
		}
		
		#print_r($vote_counts);
		
?>
<table
	id="current_poll_results"
>
	<caption>Current Poll Results</caption>
	<thead>
		<tr>
			<th>Anwswer</th>
			<th>Percentage</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach ($vote_counts as $vote_count):
			echo "<tr>\n";
			
			echo "<td>\n";
			echo stripcslashes($vote_count['answer']);
			echo "</td>\n";
			
			echo "<td>\n";
			
			if ($vote_count['vote_count']) {
				printf("%.1f\n", (($vote_count['vote_count'] / $total_votes) * 100));
			} else {
				echo '0.0';
			}
			echo "</td>\n";
			
			echo "</tr>\n";
		endforeach;
?>
	<tbody>
</table>
<?php
	}
}
?>