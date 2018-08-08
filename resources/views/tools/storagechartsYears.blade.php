<?php

		$dataPoints1 = array(

				array("label"=> "2010", "y"=> $GLOBALS['intrate_2010']),
				array("label"=> "2011", "y"=> $GLOBALS['intrate_2011']),
				array("label"=> "2012", "y"=> $GLOBALS['intrate_2012']),
				array("label"=> "2013", "y"=> $GLOBALS['intrate_2013']),
				array("label"=> "2014", "y"=> $GLOBALS['intrate_2014']),
				array("label"=> "2015", "y"=> $GLOBALS['intrate_2015']),
				array("label"=> "2016", "y"=> $GLOBALS['intrate_2016']),
				array("label"=> "2017", "y"=> $GLOBALS['intrate_2017']),
				array("label"=> "2018", "y"=> $GLOBALS['intrate_2018'])

		);

		$dataPoints2 = array(

				array("label"=> "2010", "y"=> $GLOBALS['iesite_2010']),
				array("label"=> "2011", "y"=> $GLOBALS['iesite_2011']),
				array("label"=> "2012", "y"=> $GLOBALS['iesite_2012']),
				array("label"=> "2013", "y"=> $GLOBALS['iesite_2013']),
				array("label"=> "2014", "y"=> $GLOBALS['iesite_2014']),
				array("label"=> "2015", "y"=> $GLOBALS['iesite_2015']),
				array("label"=> "2016", "y"=> $GLOBALS['iesite_2016']),
				array("label"=> "2017", "y"=> $GLOBALS['iesite_2017']),
				array("label"=> "2018", "y"=> $GLOBALS['iesite_2018'])

		);

?>


<script>

		window.onload = function () {

				var chart = new CanvasJS.Chart("chartContainer", {
					title: {
						text: "Total cars by year"
					},
					theme: "light2",
					animationEnabled: true,
					toolTip:{
						shared: true,
						reversed: true
					},
					axisY: {
						suffix: ""
					},
					data: [{
						type: "stackedColumn",
						name: "Incoming",
						showInLegend: true,
						yValueFormatString: "#,##0 cars",
						dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
					},{
						type: "stackedColumn",
						name: "Outgoing",
						showInLegend: true,
						yValueFormatString: "#,##0 cars",
						dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
					}]
				});

				chart.render();

		}

</script>
