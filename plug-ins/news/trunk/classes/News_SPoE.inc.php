<?php
class
	News_SPoE
{
	public static function
		render_latest_news_items_ol(
			HTMLTags_URL $news_item_root_url,
			$max_news_items_to_display = 10,
			$max_chars_in_first_paragraph = 100
		)
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	*
FROM
	hpi_news_items
ORDER BY
	submitted DESC
LIMIT
	0, $max_news_items_to_display
	
SQL;
		
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		$news_items = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$news_items[] = $row;
		}
		
		/*
		 * Print of the news items.
		 */
		echo '<div style="clear:both;"></div>' . "\n";
		echo '<ol id="news_items">' . "\n";
		
		foreach ($news_items as $news_item) {
			echo "<li>\n";
			
			/*
			 * The title,
			 */
			echo '<h4>';
			
			echo '<a ';
			
			$current_news_item_url = clone $news_item_root_url;
			
			$current_news_item_url->set_get_variable('news_item_id', $news_item['id']);
			
			echo 'href="' . $current_news_item_url->get_as_string() . '"';
			
			echo " >\n";
			
			echo $news_item['title'];
			
			echo "</a>\n";
			
			echo "&nbsp;<span class=\"date\">\n";
			
			echo date('d/m/y', strtotime($news_item['submitted']));
			
			echo "</span></h4>\n";
			
			/*
			 * The first paragraph.
			 */
			
			echo "<p>\n";
			
			$item = $news_item['item'];
			
			$item = stripslashes($item);
			
			$item = substr($item, 0, $max_chars_in_first_paragraph);
			
			$paragraphs = Strings_Splitter::blank_line_separated($item);

			$item = $paragraphs[0];
			
			echo $item . "\n";
			
			echo "</p>\n";
			 
			echo "</li>\n";
		}
		
		echo "</ol>\n";
	}
	
	public static function
		get_latest_news_items_ol_as_string(	
			HTMLTags_URL $news_item_root_url,
			$max_news_items_to_display = 10,
			$max_chars_in_first_paragraph = 100
		
		)
	{
		$str = '';
		ob_start();
		self::render_latest_news_items_ol($news_item_root_url, $max_news_items_to_display, $max_chars_in_first_paragraph);
		$str = ob_get_clean();
		return $str;
	}
	
	public static function
		render_news_item_from_get()
	{
		$dbh = DB::m();
		
		$news_item_id = mysql_real_escape_string($_GET['news_item_id']);
		
		self::render_news_item($news_item_id);
	}
	
	public static function
		render_news_item($news_item_id)
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	*
FROM
	hpi_news_items
WHERE
	id = $news_item_id
SQL;

		$result = mysql_query($query, $dbh);
		
		if (mysql_num_rows($result) == 0) {
			throw new Exception('No news item found!');
		} else {
			$news_item = mysql_fetch_assoc($result);
			
			/*
			 * The title,
			 */
			echo '<h3>';
			
			echo $news_item['title'];
			
			echo "&nbsp;\n";
			
			echo date('d/m/y', strtotime($news_item['submitted']));
			
			echo "</h3>\n";
			
			/*
			 * The first paragraph.
			 */
			
			$item = $news_item['item'];
			
			$item = stripslashes($item);
			
			$paragraphs = Strings_Splitter::blank_line_separated($item);
			
			foreach ($paragraphs as $p) {
				echo "<p>$p</p>\n";
			}
		}
	}
}
?>
