<?php

$dataPoints = array(
   array("label"=>"Outgoing cars", "symbol" => "Out","y"=>$GLOBALS['iesite']),
   array("label"=>"Incoming cars", "symbol" => "In","y"=>$GLOBALS['intrate']),
)

?>
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
  theme: "light2",
  animationEnabled: true,
  title: {
    text: "Incoming/Outgoing"
  },
  data: [{
    type: "doughnut",
    indexLabel: "{symbol} - {y}",
    yValueFormatString: "#0 \"cars\"",
    showInLegend: true,
    legendText: "{label} : {y}",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

}
</script>
</head>


