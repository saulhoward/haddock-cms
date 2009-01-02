<?php
/**
 * MailingList_PeopleTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Table.inc.php';

class
    MailingList_PeopleTable
extends
    Database_Table
{
    public function
        add_person (
            $name,
            $email,
            $force_email = FALSE,
            $status = 'new'
        )
    {
        //echo "\$name: $name\n";
        //echo "\$email: $email\n";
        
        /*
         * Check the given name.
         */
        if ((strlen($name) == 0) or (strlen($email) == 0)) {
            #echo "About to throw a new MailingList_NameAndEmailException.";
            
            throw new MailingList_NameAndEmailException();
        }
        
        $max_name_length = 50;
        if (strlen($name) > $max_name_length) {
            throw new MailingList_NameTooLongException($max_name_length);
        }
        
        /*
         * Check the given email address.
         */
        $max_email_length = 50;
        if (strlen($email) > $max_email_length) {
            throw new MailingList_EmailTooLongException($max_email_length);
        }
        
        if (
            !$force_email
            and
            !preg_match('/^[a-z0-9._-]+(?:\+.*)?@[a-z0-9-]+(?:\.[a-z0-9-]+)*\.[a-z]{2,6}$/i', $email)
        ) {
            throw new MailingList_InvalidEmailException($email);
        }
        
        $person_values = array();
        
        $person_values['name'] = $name;
        $person_values['email'] = $email;
        $person_values['added'] = 'NOW()';
        $person_values['status'] = $status;
        $person_values['sort_order'] = $this->max_all_rows('sort_order') + 1;
        
        return $this->add($person_values);
    }

    public function
        edit_person (
            $edit_id,
            $name,
            $email,
            $status
        )
    {

    $person_values = array();
        $person_values['name'] = $name;
        $person_values['email'] = $email;
        $person_values['status'] = $status;
        $person_values['sort_order'] = $this->max_all_rows('sort_order') + 1;
        
        $this->update_by_id($edit_id, $person_values);

    }

    public function
        delete_person (
            $delete_id
        )
        {

        $person_row = $this->get_row_by_id($delete_id);

        #
        #Delete from web_videos table
        #
        $this->delete_by_id($person_row->get_id());
        }
        
 public function
        add_person_with_date (
            $name,
            $email,
            $added,
            $status = 'new'
        )
    {

    $person_values = array();
        $person_values['name'] = $name;
        $person_values['email'] = $email;
        $person_values['added'] = $added;
        $person_values['status'] = $status;
        $person_values['sort_order'] = $this->max_all_rows('sort_order') + 1;
        
        return $this->add($person_values);
    }
    
public function count_people() {
    
        #$conditions = array();
        #$conditions['status'] = 'display';
        
        return $this->count_all_rows();
        
        #return $this->count_rows_where($conditions);
        
    }
}
?>
