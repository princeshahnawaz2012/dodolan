<!DOCTYPE HTML>
<html>
<head>
<title><?=$this->config->item('site_name')?> <? if(isset($pT)){ echo ' | '. $pT ;}elseif(!isset($pT) && isset($pH)){echo ' | '.$pH;}?></title>

<!-- CSS and JS Global -->
<link href="<?=base_url();?>assets/global_css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/ui-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/text.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/global_css/grid.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?=base_url();?>assets/global_css/font_face.css" type="text/css" media="screen" title="no title" charset="utf-8">

<?//$this->dodol_theme->load_css()?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/global_js/jquery_ui/theme/Aristo/jquery-ui-1.8.7.custom.css" media="screen"  />	
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/global_js/jgrowl/jquery.jgrowl.css" media="screen"  />	

<script src="<?=base_url();?>/assets/global_js/jquery.min.js"></script>
<script src="<?=base_url();?>/assets/global_js/jquery_ui/jquery-ui.min.js"></script>
<script src="<?=base_url();?>/assets/global_js/jquery_ui/jquery-ui-timepicker-addon.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="<?=base_url();?>/assets/global_js/dodolan_js_lib.js"></script>
<script type="text/javascript" src="<?=base_url();?>/assets/global_js/jgrowl/jquery.jgrowl.js"></script>
<script src="<?=base_url();?>/assets/global_js/flip/jquery.flip.js" type="text/javascript" charset="utf-8"></script>

<!-- Css and JS for Specify Individual Theme -->
<link href="<?=base_url();?>assets/theme/front/css/front-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/page_style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/cloud_zoom.css" rel="stylesheet" type="text/css" />

<!-- ZEROCLIPBOARD -->
<script src="<?=base_url();?>/assets/global_js/zeroclip/ZeroClipboard.js" type="text/javascript" charset="utf-8"></script>

<!--Extension JS for Individual Theme -->
<script type="text/javascript" src="<?=base_url();?>assets/theme/front/js/cloud-zoom.1.0.2.js"></script>



<?=modules::run('ajax/js_showmsg')?>
</head>
<body  <?if(isset($jsBodyAction)){echo $jsBodyAction;}?> id="<?=$this->router->class.'_'.$this->router->method;?>" >
