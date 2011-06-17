<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$this->config->item('site_name')?> | 	<? if(isset($pT)){ echo $pT ;}elseif(!isset($pT) && isset($pH)){echo $pH;}?></title>

<!-- CSS and JS Global -->
<link href="<?=base_url();?>assets/global_css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/ui-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/text.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/grid.css" rel="stylesheet" type="text/css" />
<?//$this->dodol_theme->load_css()?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/global_js/jquery_ui/theme/Aristo/jquery-ui-1.8.7.custom.css" media="screen"  />	
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/global_js/jgrowl/jquery.jgrowl.css" media="screen"  />	

<script src="<?=base_url();?>/assets/global_js/jquery.min.js"></script>
<script src="<?=base_url();?>/assets/global_js/jquery_ui/jquery-ui.min.js"></script>
<script src="<?=base_url();?>/assets/global_js/jquery_ui/jquery-ui-timepicker-addon.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="<?=base_url();?>/assets/global_js/dodolan_js_lib.js"></script>
<script type="text/javascript" src="<?=base_url();?>/assets/global_js/jgrowl/jquery.jgrowl.js"></script>

<!-- Css and JS for Specify Individual Theme -->
<link href="<?=base_url();?>assets/theme/front/css/front-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/page_style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/cloud_zoom.css" rel="stylesheet" type="text/css" />

<!--Extension JS for Individual Theme -->
<script type="text/javascript" src="<?=base_url();?>assets/theme/front/js/cloud-zoom.1.0.2.js"></script>

<?=modules::run('ajax/js_showmsg')?>

</head>

<body <?if(isset($jsBodyAction)){echo $jsBodyAction;}?> id="<?=$this->router->class.'_'.$this->router->method;?>" >
		<div class="wrapper">		
		<!-- INDEX -->
		<div class="wrapperInner grid_700 ctr">
			<div class="header">
				<h1><?=$this->config->item('site_name');?></h1>
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
</body>
</html>
	
	
	