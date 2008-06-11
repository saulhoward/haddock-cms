<?php
/**
 * A div that is displayed if the customer has completed payment
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$payment_confirmed_div = new HTMLTags_Div();
$payment_confirmed_div->set_attribute_str('id', 'payment_confirmed_div');
$payment_confirmed_div->append_tag_to_content(
	new HTMLTags_P('
	Thank you for your payment. 
	Your transaction has been completed, and a receipt for your purchase has been emailed to you.
	')
);
$payment_confirmed_div->append_tag_to_content(
	new HTMLTags_P('Your order has been dispatched and is on its way to you now.')
);
echo $payment_confirmed_div->get_as_string();
?>
