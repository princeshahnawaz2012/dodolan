/*
 * Just Another Carousel v1.0
 * http://intrepidstudios.com/projects/jquery-just-another-carousel/
 *
 * Copyright (c) 2009 Kamran Ayub
 * Licensed under the GPL license.
 * http://intrepidstudios.com/projects/jquery-just-another-carousel/#license
 *
 * Last Modified: Feb 2, 2009
 * This file is part of Just Another Carousel.

    Just Another Carousel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Just Another Carousel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Just Another Carousel.  If not, see <http://www.gnu.org/licenses/>.
*/
(function($) {
	$.fn.jac = function (options) {          
    
		//
		// build main options before element iteration
		//
		var opts = $.extend({}, $.fn.jac.defaults, options);
		
		//
		// iterate and construct the carousel
		//
	    return this.each(function() {
    	
			// the viwport
			var $vp = $(this);
			var $vpw = Math.round($vp.width()); 
			var $c = $vp.children("ul:only-child");
			
			// Only support one carousel per viewport
			if($c.length > 1) return;
			
			// element specific options
			var settings = $.meta ? $.extend({}, opts, $vp.data()) : opts;
			// selectors
	    	var sel = {
		        carouselSelector: "." + settings.carouselSelector,
		        childSelector: "." + settings.childSelector,
		        leftArrowSelector: "." + settings.leftArrowSelector,
		        rightArrowSelector: "." + settings.rightArrowSelector
		    };	 
		
			//
			// Setup CSS
			//
		    $vp
			.addClass("jac")
			.children("ul")
	        .addClass(settings.carouselSelector)
	        .children("li")
	        .addClass(settings.childSelector);
			// carousel wrapper
       		$c.wrapAll(
		        $("<div class='carousel-wrapper'></div>")
		        .css({
		            "overflow":"hidden",
		            "width" : $vpw,
		            "height" : $vp.height(),
		            "position" : "relative"
		        })
		    );
			$c.css("width", getCarouselWidth() + "px");							                   						
			
			// Don't bother letting users move stuff if you can see everything
			if(getCarouselWidth() <= $vpw) return;  
			
			// less processing to store a fixed width
		    var childWidth = $c.find(sel.childSelector + ":eq(0)").width();
		    var kidsPerView = Math.floor($vpw / childWidth); 		   		      
    
			// 
			// Moves content to center of mouse cursor (where it entered hover)
			//
		    $c
		    .find(sel.childSelector)    
		    .hover(
		        function(e) {            
		            if(!settings.enableMouse) return;            
			
		            // my abs pos to carousel
		            var myAbs;

					if(settings.childSizeFixed) {
						myAbs = $c.children().index(this) * childWidth;
					} else {
						myAbs = Math.round($(this).position().left);
					}

		            // my rel pos to viewport
		            var myRel = myAbs + getCarouselPos();
            
		            // my abs pos to carousel - centered
		            var myAbsC = myAbs + Math.round($(this).width() / 2);

		            // mouse rel to viewport
		            var mouseRelV = Math.round(e.pageX) - $vp.offset().left;

		            // mouse rel to my center
		            var mouseRelC = mouseRelV - myAbsC;

		            // new position to move to
		            var newPos = myAbsC - mouseRelV;
            
		            // new rel position, left
		            var newRelPosL = myAbs - newPos;
		            var newRelPosR = $(this).width() + myAbs - newPos;
			
					// compensate for $'s -1 off
					if(!settings.childFixedSize) newRelPosR += 1;
			
		            // Keep from going outside the viewport
		            if (newRelPosL <= 0) newPos = newPos + newRelPosL;
		            if (newRelPosR >= $vpw) newPos = newPos + (newRelPosR - $vpw);
			
		            // Stop all animations (smoothly)
		            $c.stop().animate({
		                "left": -newPos
		            }, settings.childSlideSpeed, settings.easingStyle, onMoveFinished);
		        },
		        function(e) {            
		            if(!settings.enableMouse) return;
            
		            $c.stop();
		        });			
    
			// 
			// Handle navigation
			//
		    if(getCarouselWidth() > $vpw) {                                                		
				
				$vp.append("<span class='"+settings.leftArrowSelector+"'></span>");
		        $vp.append("<span class='"+settings.rightArrowSelector+"'></span>");
		
		        // left arrow    
		        $vp.find(sel.leftArrowSelector)
		        .html("<a href='javascript:void(0)' title='"+settings.leftText+"'>"+settings.leftText+"</a>")
		        .css("opacity", 0.7)
		        .find("a")
		        .hover(function() { $(this).parent().fadeTo(settings.fadeSpeed,1); }, function(){ $(this).parent().fadeTo(settings.fadeSpeed,0.7); })                    
		        .click(function() {
		            var movePos, newPos;
		            newPos = getCarouselPos() + $vpw;
            
		            if(checkReachedEdge("left")) {onMoveFinished(); return;}
            
		            if(!settings.enableMouse && settings.childSizeFixed) {
						// move so we show equal amounts of kids at once
						// if the mouse is enabled, this wouldn't make sense
		                movePos = kidsPerView * childWidth;
		            } else {
						// children are variable, so move viewport width
		                movePos = $vpw;
		            }                    
            	
		            if (newPos > 0) {				
		                movePos = -getCarouselPos();
		            }

				    movePos = movePos + getCarouselPos();

		            $c.stop();
		            $c.animate({
		                "left": movePos
		            }, settings.parentSlideSpeed, settings.easingStyle, onMoveFinished);
		        }); // left
        
		        // right arrow
		        $vp.find(sel.rightArrowSelector)
		        .html("<a href='javascript:void(0)' title='"+settings.rightText+"'>"+settings.rightText+"</a>")
		        .css("opacity", 0.7)
		        .find("a")       
		        .hover(function() { $(this).parent().fadeTo(settings.fadeSpeed,1); }, function(){ $(this).parent().fadeTo(settings.fadeSpeed,0.7); })             
		        .click(function() {
		            var movePos, newPos;
		            newPos = -getCarouselPos() + $vpw;

		            if(!settings.enableMouse && settings.childSizeFixed) {
		                movePos = kidsPerView * childWidth;
		            } else {
		                movePos = $vpw;
		            }

			
		            if (newPos >= getCarouselWidth() - $vpw) {
		                movePos = (getCarouselWidth() - $vpw) + getCarouselPos();
		            }			
			
					movePos = movePos - getCarouselPos();
			
		            $c.stop();
		            $c.animate({
		                "left": -movePos
		            }, settings.parentSlideSpeed, settings.easingStyle, onMoveFinished);                
		        }); // next

				// In case its decided that the carousel has a different
				// initial pos
				if(checkReachedEdge("left")) {
					$vp.find(sel.leftArrowSelector).hide();
				}
		
				if(checkReachedEdge("right")) {
					$vp.find(sel.rightArrowSelector).hide();
				}
        
		    } // navigation
		
			// Get the carousel width
			function getCarouselWidth() {
				var w = 0;

				// Get carousel width
				if(settings.childFixedSize) {
					w = $c.find(sel.childSelector).length * childWidth;
				} else {

					$c.find(sel.childSelector).each(function() {
						w += $(this).width();
					});

				}
				return w;
			}
	
			// When animation finishes, checks to see if carousel reached edge,
			// and hides/shows arrows
			function onMoveFinished() {
		
				if(checkReachedEdge("left")) {
					$vp.find(sel.leftArrowSelector).hide("normal");
				} else {
					$vp.find(sel.leftArrowSelector).show("normal");
				}
		
				if(checkReachedEdge("right")) {
					$vp.find(sel.rightArrowSelector).hide("normal");
				} else {
					$vp.find(sel.rightArrowSelector).show("normal");
				}
			}
	
			// Checks to see if the carousel
			// has reached an edge
			function checkReachedEdge(side) {
				switch(side) {
					case "left":
						if(Math.round(getCarouselPos()) >= 0) return true;				
						break;
					case "right":
						var rightEdge = Math.round((getCarouselWidth() - $vpw) + getCarouselPos());

						if(rightEdge <= 0) return true;	
							
						break;			
				}
		
				return false;
			}			
	
			// For some reason, $'s position().left
			// is off by 1 pixel. So we get it from the CSS instead since that's
			// what we're manipulating.
			function getCarouselPos() {
				return getCssPos($c);
			}
    
	    }); // return this.each
	
	}; // jac
	
	//
	// Returns a number for the CSS left position
	//
	function getCssPos(el) {
		var cssPos = $(el).css("left");

		return Math.round(parseInt(cssPos.replace("px","")));
	}
	
	//
	// plugin defaults
	//
	$.fn.jac.defaults = {
        carouselSelector: "carousel",
        childSelector: "jac-content",
        leftArrowSelector: "arrow-left",
        rightArrowSelector: "arrow-right",
        easingStyle: "swing",
   		rightText: "Next",
		leftText: "Previous",
   		childSizeFixed: true,
        childSlideSpeed: 300,        
        parentSlideSpeed: 600,
        fadeSpeed: 300,
        enableMouse: false
    }; // defaults
	
//
// end of closure
//
})(jQuery);