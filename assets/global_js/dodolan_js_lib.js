// Dodolan Jquery Lib
// Author : Zidni Mubarock
// Url    : http://barockprojects.com
// Email  : zidmubarock@gmail.com
// file name : dodolan_js_lib.js

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
$(document).ready(function(){

		$(".hastime").datetimepicker({
			dateFormat:"yy-mm-dd",
			timeFormat: 'hh:mm:ss'
			});
});
$(document).ready(function(){
	
	var current = $(location).attr('href');
	$('a').each(function(){
		var a_link = $(this).attr("href"); 
		if(a_link == current){
			$(this).addClass('current_link');
		}
		
	});

});
$(document).ready(function(){
	$(".table-Ui tbody tr:visible:even",this).addClass("even"); 
    $(".table-Ui tbody tr:visible:odd",this).addClass("odd");
});

// delte confirmation 
$(document).ready(function(){
	$('span.del').click(function(){
		var link = $(this).parent().attr('href');
		$('.ajaxdialog').append('Are you Sure to Delete this item permanently ?');
		$('.ajaxdialog').dialog({
					resizable: false,
					title: 'Delete Confirmation', 
					height:140,
					buttons: {
						"Yes": function() {
							$(location).attr('href',link);
							$( this ).empty().dialog('destroy');
						},
						Cancel: function() {
							$( this ).dialog( "close" );
							$( this ).empty().dialog('destroy');
						}
					}
				});
		return false;
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

(function($){
	$.fn.notice = function(title, content) {
		$(this).append('<div class="header_notice">'+content+'</div>');
		$(this).dialog({
			title: title,
			show: 'easeInExpo',
			hide: 'easeOutExpo',
			minHeight: 100,
			create: function(event, ui) {

			},
			open: function(event, ui){
			$('.ui-dialog').addClass('msg-Ui');
			$('.ui-dialog-titlebar').addClass('msg-header');
			$('.ui-dialog-titlebar').addClass(title);


			},
			close: function(event, ui) {
			$('.ui-dialog').removeClass('msg-Ui');
			$('.ui-dialog-titlebar').removeClass('');
			$(this).empty().dialog('destroy');
	}
});




}

})(jQuery);

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
(function($) {

    $.fn.jRedi = function(location) {
	$(location).attr('href', location)
	}
})(jQuery);

jQuery.event.special.keyupdelay = {
    add : function(handler, data, namespaces) {
        var delay = data && data.delay || 100,
            that = this;

        return function(event) {                                                
            setTimeout(function() { handler.apply(that, arguments);}, data);
        }
    },

    setup: function(data, namespaces) {
        jQuery(this).bind("keyup", jQuery.event.special.keyupdelay.handler);
    },

    teardown: function(namespaces) {
        jQuery(this).unbind("keyup", jQuery.event.special.keyupdelay.handler);        
    },

    handler: function(event) {              
        event.type = "keyupdelay";
        jQuery.event.handle.apply(this, arguments);
    }
};

/*! Copyright 2011, Ben Lin (http://dreamerslab.com/)
* Licensed under the MIT License (LICENSE.txt).
*
* Version: 1.0.0
*
* Requires: jQuery 1.2.6+
*/

$.fn.center = function( options ){
  
  // cache gobal
  var $w = $( window ),

  scrollTop = $w.scrollTop();

  return this.each( function(){
    
    // cache $( this )
    var $this = $( this ),
    
    // merge user options with default settings
    settings = $.extend({
      against : 'window',
      top : false,
      topPercentage : 0.5
    }, options ),
    
    centerize = function(){
      var $against, x, y;
      
      if( settings.against === 'window' ){
        $against = $w;
      }else if( settings.against === 'parent' ){
        $against = $this.parent();
        scrollTop = 0;
      }else{
        $against = $this.parents( against );
        scrollTop = 0;
      }
      
      x = (( $against.width()) - ( $this.outerWidth())) * 0.5;
      y = (( $against.height()) - ( $this.outerHeight())) * settings.topPercentage + scrollTop;

      if( settings.top ) y = settings.top + scrollTop;

      $this.css({
        'left' : x,
        'top' : y
      });
    };
    
    // apply centerization
    centerize();
    $w.resize( centerize );
  });
};

