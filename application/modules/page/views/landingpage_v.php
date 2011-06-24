<?=load_widget('front_landing')?>
<div class="footer">
	<div class="resource_bottom">	
		<div class="resource_left left grid_650">
		<?=load_widget('bottom_left_resource');?>
		</div>
		<div class="resource_right right grid_280">
        <?=load_widget('bottom_right_resource');?>
			<div class="front_resource_menu">
				<ul>
					<li><a href="">about us</a></li>
					<li><a href="">store policies</a></li>
					<li><a href="">privacy</a></li>
					<li><a href="">contact</a></li>
					<li><a href="">blog</a></li>
				</ul>
			<div class="clear"></div>
			</div>
			<div class="news_letter_form">
				<p>keep in touch with us, and recieve our update</p>
				<form action="index_submit" method="get" accept-charset="utf-8">
					<div class="form_spot">
					<input type="text" value="youmail@site.com, your name" class="required">
					<input type="submit" name="signup_me" value="Submit" class="trigger" id="signup_me">
					<div class="clear"></div>
					</div>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
