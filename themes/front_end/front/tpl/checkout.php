<?=$this->dodol_theme->partial('header');?>

		<div id="tpl_checkout" class="wrapper">		
		<!-- INDEX -->
		<div class="wrapperInner grid_750 ctr">
			<div class="header">
				
				<div class="toppest_spot">
				<div class="logo_spot left"><h1 clas="myriad"><?=$this->config->item('site_name');?></h1></div>
				<div class="right absolute" style="bottom:15px; right:0px"><span><?=$pT?><span></div>
				<div class="clear"></div>
				</div>
			</div>

		<div class="ctr">

		<? if(isset($directLayer)){ echo $directLayer ;}?>
		<? if(isset($mainLayer)){ echo $this->load->view($mainLayer) ;}?>
		</div>

		<div class="clear"></div>
	
		</div>
		<!-- END INDEX -->
	

		<div id="front_ajaxdialog" class="ajaxdialog hide msg-Ui">

		</div>
		<script type="text/javascript" charset="utf-8">
			$('.mainComp').hide();
			$(document).ready(function(){
					$('.mainComp').show('fade', 1000);
			});
			$(document).unload(function(){
					$('.mainComp').hide('fade', 1000);
			});
		</script>
		</div>
<?=$this->dodol_theme->partial('footer');?>
	
	