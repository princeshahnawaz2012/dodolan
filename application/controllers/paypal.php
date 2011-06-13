<?php
/**
 * PayPal_Lib Controller Class (Paypal IPN Class)
 *
 * Paypal controller that provides functionality to the creation for PayPal forms, 
 * submissions, success and cancel requests, as well as IPN responses.
 *
 * The class requires the use of the PayPal_Lib library and config files.
 *
 * @package     CodeIgniter$this->paypal_lib
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

class Paypal extends MX_Controller {

	function Paypal()
	{
		parent::__construct();
		$this->load->library('paypal_lib');
	}
	
	function index()
	{
		$this->auto_form();
	}
	
	function form()
	{
		/*
		$item = '';
		for($i=1;$i<=3;$i++){
			$item .= '<input type="hidden" name="item_name_'.$i.'" value="Macbook Pro version '.$i.'">
					 <input type="hidden" name="item_number_'.$i.'" value="00'.$i.'">
					 <input type="hidden" name="amount_'.$i.'" value="10">
					 <input type="hidden" name="quantity_'.$i.'" value="'.$i.'">';
			}
		*/
		echo '
		<form method="post" action="https://www.paypal.com/cgi-bin/webscr" target="paypal">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="zidmubarock@gmail.com">
		<input type="hidden" name="invoice" value="87676">
		<input type="hidden" name="custom" value="123">
		<input type="hidden" name="handling_1" value="123">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="item_name_1" value="Britcady">
							 <input type="hidden" name="item_number_1" value="266">
							 <input type="hidden" name="amount_1" value="18.50">
							 <input type="hidden" name="quantity_1" value="19"><input type="hidden" name="on0_1" value="Size">
								  <input type="hidden" name="os0_1" value="xl">
								  <input type="hidden" name="on1_1" value="color">
								  <input type="hidden" name="os1_1" value="yellow">
								 <input type="hidden" name="item_name_2" value="asuh">
							 <input type="hidden" name="item_number_2" value="268">

							 <input type="hidden" name="amount_2" value="98.89">
							 <input type="hidden" name="quantity_2" value="1"><input type="hidden" name="on0_2" value="Size">
								  <input type="hidden" name="os0_2" value="m">
								  <input type="hidden" name="on1_2" value="color">
								  <input type="hidden" name="os1_2" value="red">
		
	
	
		<input type="image" src="http://images.paypal.com/en_US/i/btn/x-click-but22.gif" border="0" name="submit" width="87" height="23" alt="Make payments with PayPal">
		</form>
       ';
	}

	function auto_form()
	{
		$this->paypal_lib->add_field('business', 'rekzid_1299872348_biz@gmail.com');
	    $this->paypal_lib->add_field('return', site_url('paypal/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', '1234567890'); // <-- Verify return
	 	$this->paypal_lib->add_field('invoice', '766765'); // <-- Verify return
	    $this->paypal_lib->add_field('item_name', 'Paypal Test Transaction');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', '197.70');
		$this->paypal_lib->add_field('shipping', '10');

	    echo $this->paypal_lib->paypal_form();
	}
	function cancel()
	{
		$this->load->view('paypal/cancel');
	}
	
	function success()
	{
		// This is where you would probably want to thank the user for their order
		// or what have you.  The order information at this point is in POST 
		// variables.  However, you don't want to "process" the order until you
		// get validation from the IPN.  That's where you would have the code to
		// email an admin, update the database with payment status, activate a
		// membership, etc.
	
		// You could also simply re-direct them to another page, or your own 
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code 
		// below).

		$data['pp_info'] = $_POST;
		$this->load->view('paypal/success', $data);
	}
	
	function ipn()
	{
		// Payment has been received and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc. You can access a slew of information via the ipn_data() array.
 
		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.
 
		// For this example, we'll just email ourselves ALL the data.
		$to    = 'YOUR@EMAIL.COM';    //  your email

		if ($this->paypal_lib->validate_ipn()) 
		{
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "\n$key: $value";
	
			// load email lib and email results
			$this->load->library('email');
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('CI paypal_lib IPN (Received Payment)');
			$this->email->message($body);	
			$this->email->send();
		}
	}

	function generate_form($order_id){
		$order = modules::run('store/order/getorder', $order_id);
		$items = $order['data']['prodsold_data'];
		$data_order = $order['data']['order'];
		$form ='';
		$form  .= '
		<form name="checkout_confirmation" id="payment" action="'.$this->paypal_lib->paypal_url.'" method="post">
		<form method="post" id="payment" action="'.$this->paypal_lib->paypal_url.'">
		<input type="hidden" name="notify_url" value="'.site_url('paypal/cancel').'">
		<input type="hidden" name="return" value="'.site_url('paypal/success').'">
		<input type="hidden" name="cancel_return" value="'.site_url('paypal/cancel').'">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="'.$this->paypal_lib->account.'">
		<input type="hidden" name="invoice" value="'.$order_id.'">
		<input type="hidden" name="custom" value="123">
		<input type="hidden" name="handling_1" value="'.$this->price($order_id, $data_order->ship_fee).'">';
		
		$i = 1;
		foreach($items as $item){
			$form .= '<input type="hidden" name="item_name_'.$i.'" value="'.$item->name.'">
					 <input type="hidden" name="item_number_'.$i.'" value="'.$item->id_prod.'">
					 <input type="hidden" name="amount_'.$i.'" value="'.$this->price($order_id, $item->price).'">
					 <input type="hidden" name="quantity_'.$i.'" value="'.$item->qty.'">';
			if($item->options != null){
				$option = json_decode($item->options);
				$form .= '<input type="hidden" name="on0_'.$i.'" value="Size">
						  <input type="hidden" name="os0_'.$i.'" value="'.$option->s.'">
						  <input type="hidden" name="on1_'.$i.'" value="color">
						  <input type="hidden" name="os1_'.$i.'" value="'.$option->c.'">
						 ';
			}
			$i++;
		}
		$form .= '
		<input  type="image" src="http://images.paypal.com/en_US/i/btn/x-click-but22.gif" border="0" name="submit" width="87" height="23" alt="Make payments with PayPal">
		</form>';
		return $form;
		
		
	}

	function price($order_id, $num){
		$data = modules::run('store/order/getorder', $order_id);
		$order = $data['data']['order'];
		if($order->currency != 'USD'){
				$rate = $this->yh_conv->conv($order->currency, 'USD');
				$new_num = $num*$rate;
				$final_num = number_format($new_num, 2, '.', '');
			}else{
				$new_num = $num;
				$final_num = number_format($new_num, 2, '.', '');
			}
		return $final_num;
	
	}
}
?>