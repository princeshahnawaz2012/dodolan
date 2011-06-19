<?=$this->dodol_theme->partial('header',false,'back');?>
	
	<?if($this->uri->segment(3) == 'first'){?>
	<script type="text/javascript" charset="utf-8">
		$('.mainGrid').hide().show('slide', {direction:'up'});
	</script>
	<?}?>
	<div id="component">
	<div class="mainWrap grid_950 ctr" id="mainArea">
	
	<!PAGE HEADING AND TOOL/>
		<?if (isset($pageTool) || isset($pH)):?>
		<div class="pageHeading">
			<?if(isset($pH)):?>
			<div class="headingTitle left">
				<h1><?=$pH?></h1>
			</div>
			<?endif?>
			
			<?if(isset($pageTool)):?>
			<div class="pageTool right">
				<?if(is_array($pageTool)):?>
					<?foreach($pageTool as $pt):?>
						<?= $pt ?>
					<?endforeach?>
				<?else:?>
					<?= $pageTool?>
				<?endif?>
			
			</div >
			<?endif?>
			<div class="clear"></div>
		</div>
		
		<?endif?>
	<!END OF PAGE HEADING>
		
	<!component start here/>
	<?if(isset($directLayer)){
	echo $directLayer;}?>
		<?if(isset($mainLayer)){$this->load->view($mainLayer);}?>
	<!component end here/>
	</div>
	</div>
<?=$this->dodol_theme->partial('footer', false,'back');?>