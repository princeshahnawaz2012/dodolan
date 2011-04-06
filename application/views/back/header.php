<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dodolan Backend - 	<? if(isset($pT)){ echo $pT ;}?></title>
<link href="<?=base_url();?>assets/theme/global_css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/ui-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/text.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/grid.css" rel="stylesheet" type="text/css" />
<link href="<?=$this->asset->theme('css', 'back', 'admin-style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/back/css/page_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/theme/jquery-ui/jquery-ui_theme/Aristo/jquery-ui-1.8.7.custom.css" media="screen"  />	

<script src="<?=base_url();?>assets/js_general/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js_general/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/theme/back/js/dodolan_js_lib.js"></script>
</head>

<body>

<div class="mainGrid">
	<div class="header grid_950 ctr relative">
		<div class="left logoTop">
		<h1 class="logoText absolute"><?=$this->config->item('site_name');?><small> Beta 0.1</small></h1>
		</div>
		<?=modules::run('backend/widget/backUserWid');?>
		<?=modules::run('backend/widget/topmenu');?>
		<div class="clear"></div>
	</div>