<?$this->load->view('back/header');?>
	<div class="grid_950 ctr">
	<div class="pageTitle left"><?if(isset($ht)){echo $ht;};?></div>
	<div class="clear"></div>
	</div>
	<div id="component">
	<div class="mainWrap grid_950 ctr" id="mainArea">
		
		<?$this->load->view('back/msg');?>
		
	<!component start here/>
		
	<?if(isset($directLayer)){
		echo $directLayer;
		}?>
		
		<?if(isset($mainLayer)){$this->load->view($mainLayer);}?>
		
	<!component end here/>

	</div>
	</div>
<?$this->load->view('back/footer');?>