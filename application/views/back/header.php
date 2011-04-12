<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$this->config->item('site_name')?> - 	<? if(isset($pT)){ echo $pT ;}?></title>
<!-- CSS and JS Global -->
<link href="<?=base_url();?>assets/global_css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/ui-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/text.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/grid.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/global_js/jquery_ui/theme/Aristo/jquery-ui-1.8.7.custom.css" media="screen"  />	
<script src="<?=base_url();?>/assets/global_js/jquery.min.js"></script>
<script src="<?=base_url();?>/assets/global_js/jquery_ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>/assets/global_js/dodolan_js_lib.js"></script>

<!-- Css and JS for Specify Individual Theme -->
<link href="<?=base_url();?>assets/theme/back/css/admin-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/back/css/page_style.css" rel="stylesheet" type="text/css" />
<!-- Extension JS for Individual Theme -->
<?=modules::run('ajax/js_showmsg')?>

</head>


<body  id="<?=$this->router->class.'_'.$this->router->method;?>" class="backend">
<div class="navigation ui-widget-header"><div class="inner ctr grid_990">
	
	<div class="left"><?=modules::run('backend/widget/topmenu');?></div> <?=modules::run('backend/widget/backUserWid');?>
	<br class="clear"/>
	</div>
</div>
<div class="grid_990 ctr">
<div class="mainGrid ui-corner-bottom">
	<div class="header grid_950 ctr relative">
		<div class="left logoTop">
		<h1 class="logoText absolute"><?=$this->config->item('site_name');?><small> Beta 0.1</small></h1>
		</div>
		<div class="clear"></div>
	</div>