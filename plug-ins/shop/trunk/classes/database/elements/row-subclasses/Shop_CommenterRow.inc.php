<?php
/**
 * Shop_CommenterRow
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

class
    Shop_CommenterRow
extends
    Database_Row

{
    public function
        get_name()
    {
        return $this->get('name');
    }

    public function
        get_name_with_possessive()
    {
	$name = $this->get('name');
	$last_char = $name[strlen($name)-1];
	if ($last_char == 's')
	{
		$name .= "'";
	}
	else
	{

		$name .= "'s";
	}
	return $name;
    } 

    public function
        get_email()
    {
        return $this->get('email');
    }
    
    public function
        get_url()
    {
        return $this->get('url');
    }

    public function
        has_url()
    {
        return strlen($this->get('url')) > 0;
    }

    public function
        get_homepage_title()
    {
        return $this->get('homepage_title');
    }

    public function
        has_homepage_title()
    {
        return strlen($this->get('homepage_title')) > 0;
    }

    public function
        get_joined()
    {
        return $this->get('joined');
    }

}
?>
