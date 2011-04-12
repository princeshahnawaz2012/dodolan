<?$this->load->view('back/header');?>
	
	<?if($this->uri->segment(3) == 'first'){?>
	<script type="text/javascript" charset="utf-8">
		$('.mainGrid').hide().show('slide', {direction:'up'});
	</script>
	<?}?>
	<div class="grid_950 ctr">
		
	<div class="pageTitle left"><?if(isset($ht)){echo $ht;};?></div>
	<div class="clear"></div>
	</div>
	<div id="component">
	<div class="mainWrap grid_950 ctr" id="mainArea">
	<!component start here/>
	<?if(isset($directLayer)){
	echo $directLayer;}?>
		<?if(isset($mainLayer)){$this->load->view($mainLayer);}?>
	<!component end here/>
	</div>
	</div>
<?$this->load->view('back/footer');?>