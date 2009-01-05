<?php
/**
 * The default form for adding an email address to the mailing list.
 *
 * @copyright Clear Line Web Design, 2007-07-20
 */

//<form
$form_email_adding = new HTMLTags_Form();

/*
 * Form altered by RFI 2007-07-13
 */
$form_action = new HTMLTags_URL();

$form_action->set_file('/');

$form_action->set_get_variable('section', 'plug-ins');
$form_action->set_get_variable('module', 'mailing-list');
$form_action->set_get_variable('page', 'mailing-list');
$form_action->set_get_variable('type', 'redirect-script');
$form_action->set_get_variable('add_person');
$form_action->set_get_variable('return_to', urlencode('/?section=project-specific&page=mailing-list'));

#echo 'action="' . $form_action->get_as_string() . "\"\n";
$form_email_adding->set_action($form_action);
$form_email_adding->set_attribute_str('method', 'POST');
    //    method="POST"
    //>
$ul_inputs = new HTMLTags_UL();

$li_name = new HTMLTags_LI();
//        <label for="name">Name:</label>
$label_name = new HTMLTags_Label('Name: ');
$label_name->set_attribute_str('for', 'name');
$li_name->append_tag_to_content($label_name);

//	<input class="name" name="name" type="text" id="name" value="
$input_name = new HTMLTags_Input();
$input_name->set_attribute_str('id', 'name');
$input_name->set_attribute_str('name', 'name');
$input_name->set_attribute_str('type', 'text');

//    if ($_SESSION['name']) {
//        echo $_SESSION['name'];
//    }
$input_name->set_attribute_str('value', isset($_SESSION['name']) ? $_SESSION['name'] : '');

//" size="17" />
#$input_name->set_attribute_str('size', 17);
//        <br />

$li_name->append_tag_to_content($input_name);

$ul_inputs->add_li($li_name);
//

$li_email = new HTMLTags_LI();
//	<label for="name">Email:</label>
$label_email = new HTMLTags_Label('Email: ');
$label_email->set_attribute_str('for', 'email');
$li_email->append_tag_to_content($label_email);

//	<input class="email" name="email" type="text" id="name" value="
$input_email = new HTMLTags_Input();
$input_email->set_attribute_str('id', 'email');
$input_email->set_attribute_str('name', 'email');
$input_email->set_attribute_str('type', 'text');

//    if ($_SESSION['email']) {
//        echo $_SESSION['email'];
//    }
$input_email->set_attribute_str('value', isset($_SESSION['email']) ? $_SESSION['email'] : '');
//" size="17" />
#$input_email->set_attribute_str('size', 17);
//        <br>

$li_email->append_tag_to_content($input_email);

$ul_inputs->append_tag_to_content($li_email);

    if (isset($_GET['email_incorrect'])) {
        $li_force_email = new HTMLTags_LI();
        //<label for="force_email">Force email:</label>
        $label_force_email = new HTMLTags_Label('Force email: ');
        $label_force_email->set_attribute_str('for', 'force_email');
        $li_force_email->append_tag_to_content($label_force_email);
        
        //<input
        //    id="force_email"
        //    name="force_email"
        //    type="checkbox"
        ///>
        $input_force_email =  new HTMLTags_Input();
        $input_force_email->set_attribute_str('id', 'force_email');
        $input_force_email->set_attribute_str('name', 'force_email');
        $input_force_email->set_attribute_str('type', 'checkbox');
        
        $li_force_email->append_tag_to_content($input_force_email);
        //<br>
        
        $ul_inputs->append_tag_to_content($li_force_email);
    }

$form_email_adding->append_tag_to_content($ul_inputs);

$li_submit = new HTMLTags_LI();
#    <input class="submit" type="submit" name="Submit" value="Submit">
$input_submit = new HTMLTags_Input();
$input_submit->set_attribute_str('id', 'submit');
$input_submit->set_attribute_str('name', 'submit');
$input_submit->set_attribute_str('class', 'submit');
$input_submit->set_attribute_str('type', 'submit');
$input_submit->set_attribute_str('value', 'Submit');

$li_submit->append_tag_to_content($input_submit);

$ul_inputs->append_tag_to_content($li_submit);

//</form>
echo $form_email_adding->get_as_string();
?>
