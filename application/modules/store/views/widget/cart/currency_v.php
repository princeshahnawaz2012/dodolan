<div class="currency_widget widget">
<div class="horline"></div>
 <span class="left padd10">Select Currency</span>
<div class="padd10 grid_50 ctr right">
	<script type="text/javascript">
        $(document).ready(function () {
           $('.currency').change(function() {
                $("#currency_select").submit();
            });
        });
    </script>
    <?
      $list_currency = array('IDR', 'USD');
    ?>
	<form id="currency_select" action="" method="post">
		<select class="currency" name="currency">
			<?foreach($list_currency as $c){
			if($c == $this->cart->currency()){
				$select = 'selected';
			}else{
				$select = '';
			}
			
			?>
			<option <?=$select;?> value="<?=$c;?>"><?=$c;?></option>	
			<?}?>
		</select>
	</form>
</div>
<div class="clear"></div>
<div class="horline"></div>
</div>