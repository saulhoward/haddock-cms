<?php
/**
 * A div that is displayed if the customer is already logged into a shop.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */
$checkout_process_div = new HTMLTags_Div();
$checkout_process_div->set_attribute_str('id', 'checkout_process_div');

$checkout_process_ul = new HTMLTags_UL();

$process_step_one_li = new HTMLTags_LI();
$process_step_one_li->append_tag_to_content(new HTMLTags_Em('Step 1'));
$checkout_process_ul->append_tag_to_content($process_step_one_li);
$process_step_two_li = new HTMLTags_LI();
$process_step_two_li->append_str_to_content('Step 2');
$checkout_process_ul->append_tag_to_content($process_step_two_li);
$process_step_three_li = new HTMLTags_LI();
$process_step_three_li->append_str_to_content('Step 3');
$checkout_process_ul->append_tag_to_content($process_step_three_li);

$checkout_process_div->append_tag_to_content($checkout_process_ul);

// Already logged in
// You are logged in as Mr. X.
$p_text = <<<TXT
Step 1 on the Checkout process
TXT;

$checkout_process_div->append_tag_to_content(new HTMLTags_P($p_text));

echo $checkout_process_div->get_as_string();
?>
