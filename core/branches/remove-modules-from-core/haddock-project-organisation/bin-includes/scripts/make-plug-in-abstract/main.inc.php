<?php
/**
 * The main .INC for the make-plug-in-abstract script.
 *
 * @copyright Clear Line Web Design, 2007-09-28
 */

if ($plug_in->is_abstract_plug_in()) {
    if (!$silent) {
        printf(
            "'%s' is already abstract!\n",
            $plug_in->get_identifying_name()
        );
    }
} else {
    if (!$silent) {
        printf(
            "Making '%s' abstract ...\n",
            $plug_in->get_identifying_name()
        );
    }
    
    $plug_in->make_abstract();
}
?>
