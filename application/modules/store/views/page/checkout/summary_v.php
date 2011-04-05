<div class="summary">
	<h3 class="left">Confirm</h3><div class="right"><?=modules::run('store/checkout/checkoutmenu')?></div> 
	<br class="clear"/>
	<div class="cartView_v">
	<div class="table-Ui">
		<table>
		 <thead>
		  <tr>
			<td align="center">No</td>
		    <td>Product Name</td>
		     <td>Price</td>
		     <td>qty</td>
		    <td>Total</td>

		  </tr>
		 </thead>
		 <tbody>

		<?$no = 1; $items  = $this->cart->contents(); foreach($items as $item){?>
		 <tr>
			<td align="center"><?=$no++?></td>
		    <td>
		    	<div class="left mr5 itemImg">
		    		<?$img=modules::run('store/product/prodImg', $item['id'])?>
		    		<img src="<?=site_url('thumb/show/50-50-crop/dir/assets/product-img/'.$img->path);?>">

		    	</div>
		    	<div class="itemDetail left">
		    	<strong><a href="<?=site_url('store/product/view/'.$item['id']);?>" alt="<?=$item['name']?>" ><?=$item['name']?></a></strong>
		    	<?if ($this->cart->has_options($item['rowid']) == true){?>
		    	<div class="horline"></div>
		    	<?echo 'color : '.$item['options']['c'].', size :'.$item['options']['s'];?>
		    	<?}?>
		    	</div>
		    	<div class="clear"></div>
			</td>
		    <td class="text_center"><?=$this->addon_store->show_price($item['price'])?></td>
		    <td class="qty text_center grid_120">
				<?=$item['qty'];?>
		 	</td>
		    <td class="text_right subtotal"><?=$this->addon_store->show_price($item['subtotal'])?></td>

			</tr>


		 <? } ?>
		<tr class="dark">
			<td colspan="4" align="right">Subtotal :</td>
			<td class="text_right totalcartvalue"> <?=$this->addon_store->show_price($this->cart->total());?></td>
		</tr>
		<?if($this->session->userdata('shipping_info')){?> 
		<tr>
		<td colspan="4" >
			<strong>Shpping Fee and Package:</strong><br/>
			<small><?=$this->session->userdata['shipping_info']['carrier']?> - <?=$this->jne->service($this->session->userdata['shipping_info']['type'])?> | <?=$this->session->userdata['shipping_info']['city']?></small>

			</td>

			<td class="text_right shipping_fee"><?=$this->addon_store->show_price($this->session->userdata['shipping_info']['fee']);?></td>
		</tr> 
		<?}?>
		<tr class="dark">
			<td colspan="4" align="right">Total</td>
			<td class="text_right final_total">
				<? 
				if(!$this->session->userdata('shipping_info')){
				$final_total = $this->cart->total();
				}else{
				$final_total = $this->cart->total() + $this->session->userdata['shipping_info']['fee'];
				}	
				?>
				 <?=$this->addon_store->show_price($final_total);?>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	</div>
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
		<div class="data"><?=$customer['address']?> sdasasdasd asdyafas asfas asda asdasua  asdauysavas afsa</div>
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
	<? 

	if($this->session->userdata('ship_to_info')){
	$customer = $this->session->userdata('ship_to_info');
	}else{
	$customer = $this->session->userdata('customer_info');
	}
	;?>
	<div class="data_rowSet">
		<div class="label">Aimed to </div>
		<div class="data"><?=$customer['first_name']?> <?=$customer['last_name']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Address </div>
		<div class="data"><?=$customer['address']?> sdasasdasd asdyafas asfas asda asdasua  asdauysavas afsa</div>
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
				<?
					$this->recaptcha->show_it();
				?>
				<br class="clear"/>
					<input type="submit" name="process" class="button right" value="Process">
				<br class="clear"/>
			</div>
			<br class="clear"/>
		</form>
	
	</div>
		
</div>