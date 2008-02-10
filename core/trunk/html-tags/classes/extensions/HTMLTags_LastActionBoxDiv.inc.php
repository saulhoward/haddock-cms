<?php
/**
 * HTMLTags_LastActionBoxDiv
 *
 * @copyright Clear Line Web Design, 2007-03-08
 */

class
    HTMLTags_LastActionBoxDiv
extends
    HTMLTags_Div
{
    public function
        __construct(
            $message,
            $no_script_href = '',
            $status = NULL
        )
    {
        #echo "\$message: $message\n";
        #echo "\$no_script_href: $no_script_href\n";
        
        parent::__construct();
            
        $this->set_attribute_str('id', 'lastActionBox');
        
        #if (strlen($no_script_href) > 0) {
        #    $this->set_attribute_str('class', 'noscript');
        #}
        
        if ($status == 'error') {
            $this->set_attribute_str('class', 'error');
        }
        
        $p = new HTMLTags_P();
        
        
        $hide_a = new HTMLTags_A('Hide');
        $hide_a->set_attribute_str('id', 'lastActionBoxA');
        $hide_a->set_href(new HTMLTags_URL($no_script_href));
            
        #if (strlen($no_script_href) < 1) {
        #    $hide_a->set_href(new HTMLTags_URL('#'));
        #} else {
        #    $hide_a->set_href(new HTMLTags_URL($no_script_href));
        #}
        
        
        $hide_a->set_attribute_str('id', 'lastActionBoxHide');
        $hide_a->set_attribute_str('title', 'Hide this notice');
        
        $p->append_tag_to_content($hide_a);
        
        $p->append_str_to_content($message);
        
        $this->append_tag_to_content($p);
    }
}

        #echo '<div id="lastActionBox">'
        #. '<p>'
        #    . '<a href="#" id="lastActionBoxHide" title="Hide this notice">Hide</a>'
        #    . 'New user <em>&quot;'
        #    . $user->get_login_name()
        #    . '&quot;' . "</em>" . ' added with id <em>'
        #    . $user->get_id()
        #. "</em></p>\n"
        #. "</div>\n"
        #        
        #. '<noscript>'
        #. '<div id="lastActionBox" class="noscript">'
        #    . '<p>'
        #    . '<a href="/user-admin.html" id="lastActionBoxHide" title="Hide this notice">Hide</a>'
        #    . 'New user <em>&quot;'
        #    . $user->get_login_name()
        #    . '&quot;' . "</em>" . ' added with id <em>'
        #    . $user->get_id()
        #. "</em></p>\n"
        #. "</div>\n"
        #. '</noscript>';
?>
