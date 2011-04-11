<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$this->config->item('site_name')?> <?if(isset($pT)){echo ' | '.$pT;}?></title>
<link href="<?=base_url();?>assets/theme/global_css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/ui-style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/text.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/global_css/grid.css" rel="stylesheet" type="text/css" />


<link href="<?=$this->asset->theme('css', 'front', 'front-style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/page_style.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url();?>assets/theme/front/css/cloud_zoom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/theme/jquery-ui/jquery-ui_theme/Aristo/jquery-ui-1.8.7.custom.css" media="screen"  />	

<script src="<?=base_url();?>assets/js_general/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js_general/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/theme/front/js/dodolan_js_lib.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/theme/front/js/cloud-zoom.1.0.2.js"></script>
</head>

<body <?if(isset($jsBodyAction)){echo $jsBodyAction;}?> class="<?=$this->router->class.'_'.$this->router->method;?>" >