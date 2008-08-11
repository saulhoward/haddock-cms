<?php
/**
 * The page for managing tables.
 *
 * RFI & SANH 2006-09-17
 */

require_once CLWD_CORE_ROOT . '/database/MySQLUserFactory.inc.php';

if (isset($_GET['table'])) {
    $mysql_user_factory = MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_server();
    $database = $mysql_user->get_database();


    $table = $database->get_table($_GET['table']);
    #print_r($table);
    
    $table_renderer = $table->get_renderer();
    
    # The heading of this panel.
    echo '<h2>Data in the "' . $table->get_name() . "\" table</h2>\n";
    
    # Confirm deleting all the rows in the table.
    if (isset($_GET['delete_all'])) {
?>
<p>     
    Are you sure that you want to delete all the rows in this table?
</p>

<p>
    <a href="/database/table-management.php?table=<?php echo $table->get_name(); ?>&delete_all=1">
        DELETE ALL
    </a>
    &nbsp;
    <a href="/database/index.php?page=table&table=<?php echo $table->get_name(); ?>">
        Cancel
    </a>
</p>

<?php
    }
    
    # Confirm deleting a row.
    if (isset($_GET['delete_id'])) {
        $row = $table->get_row_by_id($_GET['delete_id']);
        #print_r($row);
        
        echo "<p>Are you sure that you want to delete this?</p>\n";
        
        # Show the user the project.
        $row_renderer = $row->get_renderer();
        #print_r($renderer);
        
        $row_renderer->render_all_data_table();
?>
<p>
    <a href="/database/table-management.php?table=<?php echo $table->get_name(); ?>&delete_id=<?php echo $row->get_id(); ?>">
        DELETE
    </a>
    &nbsp;
    <a href="/database/tables/<?php echo $table->get_name(); ?>.html">
        Cancel
    </a>
</p>

<?php
    }
    
    # Row Adding.
    if (!(isset($_GET['delete_all']) or isset($_GET['delete_id']))) {
        $table_renderer->render_row_adding_form();
    }
    
    echo "\n";
    
    # Link back to the table list.
    echo "<p>\n";
    #echo "<a href=\"/database/index.php?page=tables-list\">Tables</a>\n";
    echo "<a href=\"/database/tables/\">Tables</a>\n";
    echo "</p>\n";
    echo "\n";
    
    # Link to the delete all confirmation page.
    echo "<p>\n";
    echo "<a href=\"/database/index.php?page=table&table=" . $table->get_name() . "&delete_all=1\">delete all</a>\n";
    echo "</p>\n";
    echo "\n";
    
    # Display the contents of the table.
    $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
    $direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
    $table_renderer->render_all_data_table($order_by, $direction);
}
?>
