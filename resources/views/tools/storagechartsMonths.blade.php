<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Raport total"
	},
	axisX: {
		interval: 1,
		intervalType: "month",
		valueFormatString: "MMM YYYY"
	},
	axisY: {
		suffix: ""
	},
	toolTip: {
		shared: true
	},
	legend: {
		reversed: true,
		verticalAlign: "center",
		horizontalAlign: "right"
	},
	data: [{
		type: "stackedColumn",
		name: "Outgoing",
		showInLegend: true,
		xValueFormatString: "MMM YYYY",
		yValueFormatString: "#,##0\" cars\"",
		dataPoints: [
			{ x: new Date(2018, 0), y: 150 },
			{ x: new Date(2018, 1), y: 50 },
			{ x: new Date(2018, 2), y: 60 },
			{ x: new Date(2018, 3), y: 61 },
			{ x: new Date(2018, 4), y: 63 },
			{ x: new Date(2018, 5), y: 65 },
			{ x: new Date(2018, 6), y: 67 },
			{ x: new Date(2018, 7), y: 67 },
			{ x: new Date(2018, 8), y: 67 },
			{ x: new Date(2018, 9), y: 67 },
			{ x: new Date(2018, 10), y: 67 },
			{ x: new Date(2018, 11), y: 67 }
	

		]
	}, 
	{
		type: "stackedColumn",
		name: "Incoming",
		showInLegend: true,
		xValueFormatString: "MMM YYYY",
		yValueFormatString: "#,##0\" cars\"",
		dataPoints: [
			{ x: new Date(2018, 0), y: 150 },
			{ x: new Date(2018, 1), y: 50 },
			{ x: new Date(2018, 2), y: 60 },
			{ x: new Date(2018, 3), y: 61 },
			{ x: new Date(2018, 4), y: 63 },
			{ x: new Date(2018, 5), y: 65 },
			{ x: new Date(2018, 6), y: 67 },
			{ x: new Date(2018, 7), y: 67 },
			{ x: new Date(2018, 8), y: 67 },
			{ x: new Date(2018, 9), y: 67 },
			{ x: new Date(2018, 10), y: 67 },
			{ x: new Date(2018, 11), y: 67 }
		]
	}]
});
chart.render();

}
</script>
