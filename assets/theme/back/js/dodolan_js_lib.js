// Dodolan Jquery Lib
// Author : Zidni Mubarock
// Url    : http://barockprojects.com
// Email  : zidmubarock@gmail.com
// file name : dodolan_js_lib.js
/*
$(document).ready(function() {
           createDropDown();
           
           $(".dropdown dt a").click(function() {
               $(".dropdown dd ul").toggle();
           });

           $(document).bind('click', function(e) {
               var $clicked = $(e.target);
               if (! $clicked.parents().hasClass("dropdown"))
                   $(".dropdown dd ul").hide();
           });
                       
           $(".dropdown dd ul li a").click(function() {
               var text = $(this).html();
               $(".dropdown dt a").html(text);
               $(".dropdown dd ul").hide();
               
               var source = $("#source");
               source.val($(this).find("span.value").html())
           });
       });

function createDropDown(class, id){
            var source = $(class);
            var selected = source.find("option[selected]");
            var options = $("option", source);
            var id = $("#target").size()+1;
            $("body").append('<dl id="target_'+id+'" class="dropdown"></dl>')
            $('target_'+id).append('<dt><a href="#">' + selected.text() + 
                '<span class="value">' + selected.val() + 
                '</span></a></dt>')
            $('target_'+id).append('<dd><ul></ul></dd>')

            options.each(function(){
                $('target_'+id+' dd ul').append('<li><a href="#">' + 
                    $(this).text() + '<span class="value">' + 
                    $(this).val() + '</span></a></li>');
            });
        }
*/
// Date Picker
// -------------------------------------------------------------------------------------/
$(document).ready(function(){
	$(".hasdate").datepicker({				
					dateFormat:"yy-mm-dd",
					changeMonth:true,
					changeYear:true,
					yearRange: 'c-90:c+0'

					});

	
  });

//Tab UI
//---------------------------------------------------------------------------------------/
$(document).ready(function() {

	//Default Action
	$(".tab-Ui .comp .item").hide(); //Hide all content
	$(".tab-Ui .nav .item:first").addClass("actv").show(); //Activate first tab
	$(".tab-Ui .comp .item:first").show(); //Show first tab content
	//On Click Event
	$(".tab-Ui .nav .item").click(function() {
		var tabId = $(this).parent().parent().attr("id");
		$('#'+tabId+' .nav .item').removeClass("actv"); //Remove any "active" class
		$(this).addClass("actv"); //Add "active" class to selected tab
		$('#'+tabId+' .comp>.item').hide(); //Hide all tab content
		var activeTab = $(this).attr("rel"); //Find the rel attribute value to identify the active tab + content
		$('#'+tabId+' .comp > .item[no='+activeTab+']').fadeIn(); //Fade in the active content
		return false;
	});

});
$(document).ready(function(){
						   
	$('.msg-Ui .msg-item .close').click(function(){
		var msgItem = $(this).parent();
		$(msgItem).fadeOut(1000);
		
	});
	$('.msg-Ui .msg-item').delay(4000).slideUp();

})
$(document).ready(function(){
	$('input[type=text],input[type=password],textarea').each(function(){
		var paddR = $(this).css('padding-right').replace("px", "");
		var paddL = $(this).css('padding-left').replace("px", "");
		var curW = $(this).css('width').replace("px", "");
		var newW = curW - (paddR*2);
		$(this).css('width', newW);
	});

});
jQuery(document).ready(function(){
jQuery('.text-input').each(function() {
	        var default_value = this.value;
	        jQuery(this).focus(function() {
	            if(this.value == default_value) {
	                this.value = '';
	            }
	        });
	       jQuery(this).blur(function() {
	            if(this.value == '') {
	                this.value = default_value;
	            }
	        });
	    });
});


//The jQuery Setup
$(document).ready(function(){
	
	$('#clonetrigger').click(function(){
		var yourclass=".clonable";  //The class you have used in your form
		var clonecount = $(yourclass).length;	//how many clones do we already have?
		var newid = Number(clonecount) + 1;		//Id of the new clone   
		
		$(yourclass+":first").fieldclone({		//Clone the original elelement
			newid_: newid,						//Id of the new clone, (you can pass your own if you want)
			target_: $("#formbuttons"),			//where do we insert the clone? (target element)
			insert_: "before",					//where do we insert the clone? (after/before/append/prepend...)
			limit_: 4							//Maximum Number of Clones
		});
		return false;
	});

});

//The Plugin Script Cloning Form
(function($) {

    $.fn.fieldclone = function(options) { 
    
		//==> Options <==//
		var settings = {
			newid_ : 0,
			target_: $(this),
			insert_: "before",
			limit_: 0
		};
        if (options) $.extend(settings, options);           

		if( (settings.newid_ <= (settings.limit_+1)) || (settings.limit_==0) ){	//Check the limit to see if we can clone

			//==> Clone <==//
			var fieldclone = $(this).clone();
			var node = $(this)[0].nodeName;
			var classes = $(this).attr("class");

			//==> Increment every input id <==//
			var srcid = 1;
			$(fieldclone).find(':input').each(function(){
				var s = $(this).attr("name"); 			
				$(this).attr("name", s.replace(eval('/_'+srcid+'/ig'),'_'+settings.newid_)); 
			});

			//==> Locate Target Id <==//
			var targetid = $(settings.target_).attr("id");
			if(targetid.length<=0){
				targetid = "clonetarget";
				$(settings.target_).attr("id",targetid);
			}		

			//==> Insert Clone <==//
			var newhtml = $(fieldclone).html().replace(/\n/gi,"");
			newhtml = '<'+node+' class="'+classes+'">'+newhtml+'</'+node+'>';
			
			eval("var insertCall = $('#"+targetid+"')."+settings.insert_+"(newhtml)"); 
		}
    };

})(jQuery);    

