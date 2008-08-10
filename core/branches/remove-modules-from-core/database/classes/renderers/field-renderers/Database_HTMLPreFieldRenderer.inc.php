<?php
/**
 * Database_HTMLPreFieldRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-15
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/field-renderers/'
    . 'Database_LongTextFieldRenderer.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Pre.inc.php';

class
    Database_HTMLPreFieldRenderer
extends
    Database_LongTextFieldRenderer
{
    public function
        get_display_str($value)
    {
        $value_pre = new HTMLTags_Pre($value);
        
        #echo "Database_HTMLPreFieldRenderer::get_display_str(...)\n";
        #print_r($value_pre);
        
        return $value_pre->get_as_string();
    }
}
?>
