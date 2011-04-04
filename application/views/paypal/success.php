<h2>Success!</h2>

<p>Your payment was received using Paypal.</p>

<?php if ($_POST): ?>
<p>Here's its information:</p>
<p><code>
<?php	
	foreach ($_POST as $key => $value)
		echo '<strong>$key</strong>: $value <br/>';
?>
</code></p>
<?php endif; ?>
