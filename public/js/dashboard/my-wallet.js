(function($) {
    /* "use strict" */


 var dlabChartlist = function(){
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	var screenWidth = $(window).width();
	var donutChart1 = function(){
		$("span.donut2").peity("donut", {
			width: "60",
			height: "60"
		});
	}
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				donutChart1();
			},
			
			resize:function(){
				
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);