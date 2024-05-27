(function($) {
    "use strict" 
   
 var dlabSparkLine = function(){
    
	var screenWidth = $(window).width();
	
	function getSparkLineGraphBlockSize(selector)
	{
		var screenWidth = $(window).width();
		var graphBlockSize = '100%';
		
		if(screenWidth <= 768)
			{
				screenWidth = (screenWidth < 300 )?screenWidth:300;
				
				var blockWidth  = jQuery(selector).parent().innerWidth() - jQuery(selector).parent().width();
		
				blockWidth = Math.abs(blockWidth);
				
				var graphBlockSize = screenWidth - blockWidth - 10;	
			}
	
		
		
		return graphBlockSize;
		
	}
	
	var sparkLineDash = function(){
		// Line Chart
		if(jQuery('#sparklinedash').length > 0 ){	 
			 $("#sparklinedash").sparkline([10, 15, 26, 27, 28, 31, 34, 40, 41, 44, 49, 64, 68, 69, 72], {
				type: "bar",
				height: "50",
				barWidth: "4",
				resize: !0,
				barSpacing: "5",
				barColor: "#FFA7D7"
			});
		}
	}
	
	var sparkLine8 = function(){
		if(jQuery('#sparkline8').length > 0 ){	
			$.ajax({
                url: "vital/get-rbs-data",
                method: "GET",
                success: function (response) {

                    $("#sparkline8").sparkline(response, {
                        type: "line",
                        //width: "100%",
                        width: getSparkLineGraphBlockSize("#sparkline8"),
                        height: "50",
                        lineColor: "#FFA7D7",
                        fillColor: "rgba(255,167,215,1)",
                        minSpotColor: "#FFA7D7",
                        maxSpotColor: "#FFA7D7",
                        highlightLineColor: "#FFA7D7",
                        highlightSpotColor: "#FFA7D7",
                    });
                }
			});
		}
	}
	
	var sparkLine9 = function(){
		if(jQuery('#sparkline9').length > 0 ){
			$.ajax({
                url: "vital/get-rr-data",
                method: "GET",
                success: function (response) {	
			$("#sparkline9").sparkline(response, {
				type: "line",
				//width: "100%",
				width: getSparkLineGraphBlockSize('#sparkline9'),
				height: "50",
				lineColor: "#886cc0",
				fillColor: "rgba(255, 92, 0, .5)",
				minSpotColor: "#886cc0",
				maxSpotColor: "#886cc0",
				highlightLineColor: "rgb(255, 159, 0)",
				highlightSpotColor: "#886cc0"
			});
		}
			});
		}
	}

    // Bar Chart
	var sparkBar = function(){
		if(jQuery('#spark-bar').length > 0 ){
			$.ajax({
                url: "vital/get-bpd-data",
                method: "GET",
                success: function (response) {	
				$("#spark-bar").sparkline(response, {
					type: "bar",
					height: "200",
					barWidth: 6,
					barSpacing: 7,
					barColor: "#ffaa2b"
				});
			}
		});
		}	
	}
	var sparkBar3 = function () {
        if (jQuery("#spark-bar-3").length > 0) {
            $.ajax({
                url: "vital/get-bps-data",
                method: "GET",
                success: function (response) {
                    $("#spark-bar-3").sparkline(response, {
                        type: "bar",
                        height: "90",
                        barWidth: 6,
                        barSpacing: 7,
                        barColor: "#ffaa2b",
                    });
                },
            });
        }
    };
		
	var sparkBar2 = function(){
		if(jQuery('#spark-bar-2').length > 0 ){	
			$.ajax({
            url: "vital/get-spo2-data",
            method: "GET",
            success: function (response) {
			$("#spark-bar-2").sparkline(response, {
				type: "bar",
				height: "90",
				width: 100,
				barWidth: 10,
				barSpacing: 10,
				barColor: "rgb(255, 206, 120)"
			});
		}
	});
		}	
	}
		
	var stackedBarChart = function(){
		if(jQuery('#StackedBarChart').length > 0 ){	
			$('#StackedBarChart').sparkline([
				[1, 4, 2],
				[2, 3, 2],
				[3, 2, 2],
				[4, 1, 2]
			], {
					type: "bar",
					height: "200",
					barWidth: 10,
					barSpacing: 7, 
					stackedBarColor: ['#FFA7D7', '#ffaa2b', '#886cc0']
				});
		}
	}
		
	var triState = function(){
		if(jQuery('#tristate').length > 0 ){	

			$("#tristate").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
				type: 'tristate',
				height: "200",
				barWidth: 10,
				barSpacing: 7, 
				colorMap: ['#FFA7D7', '#ffaa2b', '#886cc0'], 
				negBarColor: '#886cc0'
			});
		}
	}
		
	var compositeBar = function(){
		// Composite
		if(jQuery('#composite-bar').length > 0 ){
			$.ajax({
                url: "vital/get-hr-data",
                method: "GET",
                success: function (response) {
                    
					$("#composite-bar").sparkline(response, {
						type: "bar",
						height: "200",
						barWidth: "10",
						resize: true,
						// barSpacing: "7",
						barColor: "#FFA7D7", 
						width: '100%',
						
					});
				}
			});
		}	
	}	
	
	var sparklineCompositeChart = function(){
		if(jQuery('#sparkline-composite-chart').length > 0 ){
			$("#sparkline-composite-chart").sparkline([5, 6, 7, 2, 0, 3, 6, 8, 1, 2, 2, 0, 3, 6], {
				type: 'line',
				width: '100%',
				height: '200', 
				barColor: '#ffaa2b', 
				colorMap: ['#ffaa2b', '#886cc0']
			});
		}
		if(jQuery('#sparkline-composite-chart').length > 0 ){
			$("#sparkline-composite-chart").sparkline([5, 6, 7, 2, 0, 3, 6, 8, 1, 2, 2, 0, 3, 6], {
				type: 'bar',
				height: '150px',
				width: '100%',
				barWidth: 10,
				barSpacing: 5,
				barColor: '#34C73B',
				negBarColor: '#34C73B',
				composite: true,
			});
		}
	}
		
	var sparkLine11 = function(){
		if(jQuery('#sparkline11').length > 0 ){
			//Pie
			$("#sparkline11").sparkline([24, 61, 51], {
				type: "pie",
				height: "100px",
				resize: !0,
				sliceColors: ["rgba(192, 10, 39, .5)", "rgba(0, 0, 128, .5)", "rgba(255,167,215,1)"]
			});
		}	
	}	
	
	var sparkLine12 = function(){
		if(jQuery('#sparkline12').length > 0 ){
			//Pie
			$("#sparkline12").sparkline([24, 61, 51], {
				type: "pie",
				height: "100",
				resize: !0,
				sliceColors: ["rgba(179, 204, 255, 1)", "rgba(157, 189, 255, 1)", "rgba(112, 153, 237, 1)"]
			});
		}	
	}	
	
	var bulletChart = function(){
		if(jQuery('#bullet-chart').length > 0 ){
			// Bullet
			$("#bullet-chart").sparkline([10, 12, 12, 9, 7], {
				type: 'bullet',
				height: '100',
				width: '100%',
				targetOptions: { // Options related with look and position of targets 
					width: '100%',        // The width of the target 
					height: 3,            // The height of the target 
					borderWidth: 0,       // The border width of the target 
					borderColor: 'black', // The border color of the target 
					color: 'black'        // The color of the target 
				}
			});
		}
	}
		
	var boxPlot = function(){
		if(jQuery('#boxplot').length > 0 ){
			//Boxplot
			$("#boxplot").sparkline([4,27,34,52,54,59,61,68,78,82,85,87,91,93,100], {
				type: 'box'
			});
		}
	}
	
	
    /* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				sparkLineDash();	
				sparkLine8();
				sparkLine9();	
				sparkBar();	
				sparkBar2();
				sparkBar3();		
				stackedBarChart();
				triState();
				compositeBar();
				sparklineCompositeChart();
				bulletChart();
				sparkLine11();
				sparkLine12();
				boxPlot(); 
			},
			
			resize:function(){
				sparkLineDash();	
				sparkLine8();
				sparkLine9();	
				sparkBar();	
				sparkBar2();		
				sparkBar3();		
				stackedBarChart();
				triState();
				compositeBar();
				sparklineCompositeChart();
				bulletChart();
				sparkLine11();
				sparkLine12();
				boxPlot();
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabSparkLine.resize();	
		}, 1000);
	});

	jQuery(window).on('resize',function(){
		setTimeout(function(){
			dlabSparkLine.resize();	
		}, 1000);
	});     

})(jQuery);