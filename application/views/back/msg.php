
<div class="msg-Ui">
	<?php
	// display all messages
	$messages = $this->messages->get();
	
	if (is_array($messages)):
	    foreach ($messages as $type => $msgs):
	        foreach ($msgs as $message):
	            echo ('<div class="msg-item '.$type.'">
					  <span class="close"></span>'.$message.'</div>');
	        endforeach;
	    endforeach;
	endif;

	?>	

</div>