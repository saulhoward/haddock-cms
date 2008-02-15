<?php
/**
 * Navigation panel for the server admin scripts site.
 *
 * @copyright Clear Line Web Design, 2007-04-25
 */
?>
<div id="navigation">
<?php

$navigation_pages[] = array(
	'name' => 'home',
	'title' => 'Home',
	'text' => 'Home'
);

$navigation_pages[] = array(
	'name' => 'servers',
	'title' => 'Servers',
	'text' => 'Servers'
);


$navigation_pages[] = array(
	'name' => 'task-status',
	'title' => 'Task Status',
	'text' => 'Task Status'
);

# Render the links.
echo "<ul>\n";
foreach ($navigation_pages as $navigation_page) {
    echo '<li';
    if (isset($_GET['page'])) {
	if ($_GET['page'] == $navigation_page['name']) {
	    echo ' class="selected"';
	}
    }
    echo ">\n";
    
    echo '<a ';
    echo 'href="/' . $navigation_page['name'] . '.html" ';
    echo 'title="' . $navigation_page['title'] . '"';
    echo '>';
    
    echo $navigation_page['text'];
    echo "</a>\n";
    
    echo "</li>\n";
}
echo "</ul>\n";
?>
</div>
