<?php
/**
 * Shop_SumOfMoney
 *
 * @copyright Clear Line Web Design, 2007-09-18
 */

class
	Shop_SumOfMoney
{
	private $amount;
	private $currency_row;

	public function
		__construct($amount, Shop_CurrencyRow $currency_row)
	{
		$this->amount = $amount;
		$this->currency_row = $currency_row;
	}

	public function
		get_as_string($symbol = TRUE)
	{
		$str = '';

		if ($symbol)
		{
			$str .= $this->currency_row->get_symbol();
		}

		$divisor_power = 2;
		$divisor = pow(10, $divisor_power);

		$str .= sprintf('%.' . $divisor_power . 'f', $this->amount/$divisor);

		return $str;
	}
}
?>
