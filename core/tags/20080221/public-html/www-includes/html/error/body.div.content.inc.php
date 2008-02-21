<?php
/**
 * The content of the default error page.
 *
 * @copyright Clear Line Web Design, 2007-03-07 
 */

?>
<div
    id="content"
    class="error"
>
<?php
if (isset($_SESSION['exception'])) {
    $div_exception = new HTMLTags_ExceptionDiv($_SESSION['exception']);
    
    echo $div_exception->get_as_string();
} else {
    if (isset($_GET['error_message'])) {
?>
    <p>
        <?php echo stripcslashes($_GET['error_message']) . "\n"; ?>
    </p>
<?php
    }
}

if (isset($_GET['return_to'])) {
?>
    <p>
        Return to
        <a
            href="<?php echo $_GET['return_to'] . "\n"; ?>"
        >
<?php
$max_length = 100;

if (strlen($_GET['return_to']) < $max_length) {
    echo $_GET['return_to'];
} else {
    echo substr($_GET['return_to'], 0, $max_length) . ' ...';
}

echo "\n";
?>
        </a>
    </p>
<?php
}
?>
</div>
