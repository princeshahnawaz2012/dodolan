<div class="summary">
<?=$cart;?>
	<div class="customer_info grid_350 left">
	<h4>Personal Information</h4>
	<? $customer = $this->session->userdata('customer_info');?>
	<div class="data_rowSet">
		<div class="label">Name </div>
		<div class="data"><?=$customer['first_name']?> <?=$customer['last_name']?></div>
		<div class="clear"></div>
	</div>

	<div class="data_rowSet">
		<div class="label">Email </div>
		<div class="data"><?=$customer['email']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Address </div>
		<div class="data"><?=$customer['address']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Country </div>
		<div class="data"><?=$customer['country_id']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Province </div>
		<div class="data"><?=$customer['province']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">First Name </div>
		<div class="data"><?=$customer['city']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Zip </div>
		<div class="data"><?=$customer['zip']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Phone </div>
		<div class="data"><?=$customer['phone']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Mobile </div>
		<div class="data"><?=$customer['mobile']?></div>
		<div class="clear"></div>
	</div>
		
	</div>
	<div class="customer_info grid_350 right">
	<h4>Shipping Address</h4>
	<? $ship = ($ship = $this->session->userdata('shipto_info')) ? $ship : $this->session->userdata('customer_info');?>
	<div class="data_rowSet">
		<div class="label">Aimed to </div>
		<div class="data"><?=$ship['first_name']?> <?=$ship['last_name']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Address </div>
		<div class="data"><?=$ship['address']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Country </div>
		<div class="data"><?=$ship['country_id']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Province </div>
		<div class="data"><?=$ship['province']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">First Name </div>
		<div class="data"><?=$ship['city']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Zip </div>
		<div class="data"><?=$ship['zip']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Phone </div>
		<div class="data"><?=$ship['phone']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Mobile </div>
		<div class="data"><?=$ship['mobile']?></div>
		<div class="clear"></div>
	</div>
		
	</div>
	<div class="clear"></div>
	<div class="shipping_and_payment">
			<? $payment = $this->session->userdata('payment_info');?>
		<h4>Shipping and Payment</h4>
		<div class="data_rowSet">
			<div class="label">Payment Method </div>
			<div class="data"><?=$payment['method']?></div>
			<div class="clear"></div>
		</div>
		<div class="data_rowSet">
				<div class="label">Shipping Carrier </div>
				<div class="data"><?=$this->session->userdata['shipping_info']['carrier']?> - <?=$this->jne->service($this->session->userdata['shipping_info']['type'])?> | <?=$this->session->userdata['shipping_info']['city']?></div>
				<div class="clear"></div>
		</div>
		
	</div>
	<div class="customer_note mt20">
		<form action="" method="post">
			<div class="grid_300 left mr20">
			Give me a few line of note,if you want it :)
			<textarea name="customer_note" class="grid_300" rows="8"></textarea>
			</div>
			<div class="grid_300 right captcha">
				<?					$this->recaptcha->show_it();
				?>
				<br class="clear"/>
					<input type="submit" name="process" class="button right" value="Process">
				<br class="clear"/>
			</div>
			<br class="clear"/>
		</form>
	
	</div>
		
</div>