$(document).ready(function(e ) {
	$.fn.customScroll =
	function()
	{
		this.each(
		function()
		{
			var alwaysshown = true;
			var uiScrollableAreaBody = $("<div></div>").addClass("uiScrollableAreaBody").css({"":$(this).width()});
			var uiScrollableAreaWrap = $("<div></div>").addClass("uiScrollableAreaWrap");
			var uiScrollableAreaTrack = $("<div></div>").addClass("uiScrollableAreaTrack");
			var uiScrollableAreaGripper = $("<div></div>").addClass("uiScrollableAreaGripper");
			var uiScrollableArea = $("<div></div>").addClass("uiScrollableArea");
			var canScroll=true;
			var delayId;
			
			uiScrollableAreaBody.html($(this).html());
			uiScrollableAreaWrap.html(uiScrollableAreaBody);
			uiScrollableArea.html(uiScrollableAreaWrap);
			uiScrollableAreaTrack.html(uiScrollableAreaGripper);
			uiScrollableArea.append(uiScrollableAreaTrack);
			$(this).html(uiScrollableArea);
			
			
			uiScrollableAreaGripper.height(uiScrollableArea.height()/uiScrollableAreaBody.height()*uiScrollableArea.height());
			
			uiScrollableArea.mouseenter(function(e) {
				clearTimeout(delayId);
				if(uiScrollableAreaGripper.height()>uiScrollableAreaTrack.height())
				{
					uiScrollableAreaGripper.css({"display":"none"});
				}
				else
				{
					uiScrollableAreaGripper.css({"display":"block"});uiScrollableAreaGripper.stop(true).fadeTo(200,1,"swing");
				}
				
				
            });
			
			uiScrollableArea.mouseleave(function(e) {
				if(canScroll)
				{
					delayId=setTimeout(function()
					{
						if(!alwaysshown)
						{
							uiScrollableAreaGripper.stop(true).fadeTo(200,0,"swing");
						}	
					},1000);
				}
            });
			
			uiScrollableArea.mouseleave();
			
			$(window).resize(function(e) {
                uiScrollableAreaGripper.height(uiScrollableArea.height()/uiScrollableAreaBody.height()*uiScrollableArea.height());
				uiScrollableAreaGripper.css("top", uiScrollableAreaWrap.scrollTop()*uiScrollableAreaTrack.height()/uiScrollableAreaBody.height());
            });
			
			uiScrollableAreaGripper.mousedown(function(e) {
				uiScrollableArea.addClass("unselectable");
				$(this).attr("data-down",e.pageY-$(this).offset().top);
				canScroll=false;
				$("body").bind("mousemove",function(e)
				{
					if(e.pageY-uiScrollableAreaTrack.offset().top-parseInt(uiScrollableAreaGripper.attr("data-down"))<0)
						uiScrollableAreaGripper.css("top","0px");
					else
					{
						if(e.pageY-uiScrollableAreaTrack.offset().top-parseInt(uiScrollableAreaGripper.attr("data-down"))+uiScrollableAreaGripper.height()>uiScrollableAreaTrack.height())
							uiScrollableAreaGripper.css("top",uiScrollableAreaTrack.height()-uiScrollableAreaGripper.height());
						else
							uiScrollableAreaGripper.css("top",
					 e.pageY-uiScrollableAreaTrack.offset().top-parseInt(uiScrollableAreaGripper.attr("data-down")));
					}
					uiScrollableAreaWrap.scrollTop((uiScrollableAreaGripper.position().top/uiScrollableAreaTrack.height()*uiScrollableAreaBody.height()));
				});
				$("body").bind("mouseup",function()
				{
					canScroll=true;
					$("body").unbind("mousemove");	
					$("body").unbind("mouseup");
					uiScrollableArea.removeClass("unselectable");	
				});
            }); 
			uiScrollableAreaWrap.scroll(function(e) {
				if(canScroll)
					uiScrollableAreaGripper.css("top", uiScrollableAreaWrap.scrollTop()*uiScrollableAreaTrack.height()/uiScrollableAreaBody.height());
			});
		});
	};
});