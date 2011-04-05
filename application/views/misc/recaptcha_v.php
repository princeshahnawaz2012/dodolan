<script type= "text/javascript">
var RecaptchaOptions = {
theme: 'custom',
lang: 'en',
custom_theme_widget: 'recaptcha_widget'
};
</script>

<div id="recaptcha_widget" style="display: none;">
<div id="recaptcha_image"></div>
<div class="recaptcha_only_if_incorrect_sol" style="color: red;">Incorrect please try again</div>
<span class="recaptcha_only_if_image">Enter the words above:</span>
<span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>
<input id="recaptcha_response_field" name="recaptcha_response_field" type="text">
<strong style="font-size: 10px;"><a  id="recaptcha_reload_btn" href="javascript:Recaptcha.reload ();">Get another CAPTCHA</a></strong>

<!--div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div><br />
<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div><br /><br />
<div><a href="javascript:Recaptcha.showhelp()">Help</a><br />
</div-->

<script type="text/javascript" src="http://api.recaptcha.net/challenge?k=<?php echo $publickey;?>&lang=en"></script>

<noscript>
<iframe src="http://api.recaptcha.net/noscript?k=<?php echo $publickey;?>&lang=en" height="200" width="500" frameborder="0"></iframe>
<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
<input type="'hidden'" name="'recaptcha_response_field'" value="'manual_challenge'">
</noscript>

</div>