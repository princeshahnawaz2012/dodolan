<html>
<head>
<title>email_theme</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?=base_url();?>/assets/theme/email_theme/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (email_theme.psd) -->
<div class="wraper">
	
<table class="ctr" id="Table_01" valign="top" width="750" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto">
	<!-- HEader -->
	<tr>
		<td colspan="3" width="750" height="99" >
			<img src="<?=base_url();?>/assets/theme/email_theme/email_header.png">
		</td>
	</tr>
	<!-- end HEader -->
	<!-- Body -->
	<tr>
		<td width="25" > </td>
			<!-- COntent -->
		<td valign="top" width="700" id="tableConten" >
			<div id="mainLayer">
				<?if (isset($template)){ $this->load->view($template);}?>
				<?if (isset($mailmsg)){ echo $mailmsg ;}?>
			
			</div>	
		</td>
			<!-- end content -->
			
		<td width="25"  > </td>
	</tr>
	<!-- end Body -->
	<!-- Footer -->
	<tr>
		<td width="25" > </td>
			<!-- COntent -->
		<td width="700"  >
					
		</td>
			<!-- end content -->
			
		<td width="25" > </td>
	</tr>
	<!-- Footer -->
	<tr>
		<td colspan="3" width="750" >
			<img src="<?=base_url();?>/assets/theme/email_theme/line_bottom.png">
		</td>
	</tr>
	<!-- end footer -->
</table>
<!-- End Save for Web Slices -->
</div>
</body>
</html>