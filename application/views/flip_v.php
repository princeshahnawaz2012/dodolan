<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var msg = '<div class="box2 msgq ctr grid_300"><span class="bold">Success</span><br/><div class="box2">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some 	form, by injected humour, or randomised words </div></div>';
		var target = new Object();
		$('.flipper').bind('click', function(){
			var elem = $(this)
			if(elem.data('fliped') != true){
				elem.flip({
					direction:'bo',
					speed:1000,
					color:'red',
				});
				elem.data('fliped', false);
			}else{
				elem.flip({
					direction:'bc',
					speed:1000,
					color:'red',
					onEnd: function(){
						elem.hide();
					},
				});
				elem.data('fliped', true);
			}
			
			return false;
		})	;
	});
</script>
<div class="grid_300 flipper ctr" style="background:red; height:100px">

</div>
<br/>
<div class="theMsg">

</div>

<style type="text/css" media="screen">
	.msgq {
		opacity:0;
	}
</style>