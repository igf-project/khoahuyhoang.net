$(document).ready(function () {

		$('.listproject').cycle({ 
		    fx:      'fade', 
		    timeout:  6000, 
			speed: 2000
		//	pager:  $('.listproject').next('.nav')
		});

		$('.bannerFade ul').cycle({ 
		    fx:      'fade', 
		    timeout:  7000, 
			speed: 2000,
			pager:  $('.bannerFade ul').next('.nav')
		});

		$(".news_event .listitem").next().after("<div class='nextprev'><a class='prev'></a><a class='next'></a></div>");
		$('.listitem').cycle({ 
		    fx:      'scrollHorz', 
		    timeout:  6000, 
			speed: 800,
			next: '.next',
			prev: '.prev',
			pager:  $('.listitem').next('.nav')
		});

		$(".wrap_partner").jCarouselLite({
			visible: 8,
		    auto: 2500,
		    speed: 1000
		});


		if($("#scroller").length >0){
			$("#scroller").simplyScroll({
				orientation: 'vertical',
	            auto: true,
	            manualMode: 'loop',
				frameRate: 20
			});
		}

	
		
		
});

function divide4(id){
	for(i=0; i< $(id).children().length; i++){
		if(i%2==0){
			$(id).children().eq(i).addClass('nomargin');
		}
	}
}


function slice(id){
	if($(id).size() > 0){
		var Init = function(){
			var len = $("li",id).size();
			var visible = 4;
			if(len > visible){					
				for(var i=0;i< Math.ceil(len/visible);i++){
					$("li",id).slice(i*visible,i*visible+visible).wrapAll("<div class='wrapLi'></div>");
				}					
				$(id).cycle({
					fx:'scrollHorz',
					speed:1000,
					timeout:3000,
			//		prev:$('.prev',id),
			//		next:$('.next',id),
					onPrevNextEvent:function(){}
				});
			//	$('.prev,.next',id).fadeIn();
			}
		}
		Init();
	}
}