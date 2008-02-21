<?php
/**
 * The body of the class list page.
 *
 * Because this is an AJAX page, I'm putting an onload statement in
 * the body tag.
 *
 * Is this wise? A good practice?
 *
 * @copyright Clear Line Web Design, 2007-05-10
 */
?>
<body
    onload='process()'
>
<?php
require $inc_file_finder->get_filename('body.div.container');
?>
</body>
