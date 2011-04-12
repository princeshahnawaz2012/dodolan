<div class="currency_widget widget">
	<script type="text/javascript">
        $(document).ready(function () {
           $('.currency').change(function() {
                $("#currency_select").submit();
            });
        });
    </script>
    <?
    if($this->session->userdata('currency')){
    	$currency = $this->session->userdata('currency');
    }else{
    	$currency = $this->config->item('currency');
    }
    $list_currency = array('IDR', 'USD');
    ?>
	<form id="currency_select" action="" method="post">
		<span>Currency :</span><select class="currency" name="currency">
			<?foreach($list_currency as $c){
			if($c == $currency){
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