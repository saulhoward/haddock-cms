<div id="navigation">
<?php
/*
 * RFI 2009-06-18
 */

#$navigation_pages[] = array(
#	'name' => 'home',
#	'title' => 'Home',
#	'text' => 'Home'
#);
#
## Render the links.
#echo "<ul>\n";
#foreach ($navigation_pages as $navigation_page) {
#    echo '<li';
#    if (isset($_GET['page'])) {
#	if ($_GET['page'] == $navigation_page['name']) {
#	    echo ' class="selected"';
#	}
#    }
#    echo ">\n";
#    
#    echo '<a ';
#    echo 'href="/' . $navigation_page['name'] . '.html" ';
#    echo 'title="' . $navigation_page['title'] . '"';
#    echo '>';
#    
#    echo $navigation_page['text'];
#    echo "</a>\n";
#    
#    echo "</li>\n";
#}
#echo "</ul>\n";
?>
	<ul>
		<li><a href="/" title="Home">Home</a></li>
	</ul>
</div>
