<?php
/**
 * HTMLTags_ValueNotSetInSelectException
 *
 * @copyright Clear Line Web Design, 2007-02-21
 */

class
    HTMLTags_ValueNotSetInSelectException
extends
    Exception
{
    public function
        __construct($value)
    {
        parent::__construct(
            "$value is not set in HTMLTags_Select::set_value(...)!"
        );
    }
}
?>