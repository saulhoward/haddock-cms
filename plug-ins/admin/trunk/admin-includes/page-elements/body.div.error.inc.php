<?php
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/extensions/'
    . 'HTMLTags_ExceptionDiv.inc.php';
    
?>
<div id="content">
<?php
if (isset($e)) {
    $div_exception = new HTMLTags_ExceptionDiv($e);
    
    echo $div_exception->get_as_string();
}
?>
</div>
