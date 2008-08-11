<?php
/**
 * Template for the navigation panel of an admin page
 * on a database site.
 *
 * RFI & SANH 2006-09-21
 */

$navigation_links[] = array('page' => 'tables-list', 'title' => 'Tables');
$navigation_links[] = array('page' => 'sql-statement', 'title' => 'SQL Statement');

echo "<ul>\n";

foreach ($navigation_links as $navigation_link) {
    echo "<li>\n";
    
    echo '<a href="/database/';
    #echo 'index.php?page=' . $navigation_link['page'];
    echo $navigation_link['page'] . '.html';
    echo '">';
    echo $navigation_link['title'];
    echo "</a>\n";
    
    echo "</li>\n";
}

echo "</ul>\n";

unset($navigation_links);
?>
