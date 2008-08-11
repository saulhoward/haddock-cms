<?php
/**
 * Allows a user to enter an arbitrary
 * SQL statement into the database.
 *
 * RFI & SANH 2006-09-19
 */
?>
<h2>SQL Statement</h2>

<?php
if (isset($_POST['statement'])) {
    # TO DO:
    # Add methods to the database class here.
    
    echo $_POST['statement'];
}
?>

<form
    name="sql_statement"
    action="/database/index.php?page=sql-statement"
    method="POST"
>

<textarea
    cols="80"
    rows="10"
    name="statement"
></textarea>

<input
    type="submit"
    value="Go"
/>

</form>

<h3>Suggestions</h3>

<ul>
    <li><code>SELECT * FROM ... WHERE ... = ... AND ... = ... OR ...</code></li>
    <li><code>INSERT INTO ... SET ... = ..., ... = ...</code></li>
    <li><code>UPDATE ... SET ... = ..., ... = ... WHERE ... = ... AND ... = ... OR ...</code></li>
    <li><code>DELETE FROM ... WHERE ... = ... AND ... = ... OR ...</code></li>
</ul>
