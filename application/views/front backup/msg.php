<div class="msg-Ui">
	<?php
	// display all messages
	    foreach ($msg as $type => $msgs):
	        foreach ($msgs as $message):
	            echo ('<div class="msg-item '.$type.'">
					  <span class="close"></span>'.$message.'</div>');
	       endforeach;
	    endforeach;
	?>
</div>
<div class="clear"></div>