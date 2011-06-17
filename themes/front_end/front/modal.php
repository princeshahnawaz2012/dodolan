<div class="mainComp right">
<? if(isset($directLayer)){ echo $directLayer ;}?>
<? if(isset($mainLayer)){ echo $this->load->view($mainLayer) ;}?>
</div>