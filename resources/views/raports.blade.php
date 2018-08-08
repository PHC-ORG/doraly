<?php $dir = ''; ?>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">

        <script type="text/javascript" src="/js/canvasjs.js"></script>



    </head>
    <body>
	<?php include '../resources/views/tools/menu.blade.php';?>
      <div class="content-page" style="position=fixed;">

        

        <form action="{{ action('CamerasController@index') }}">

          <select name="dropDirection" id="dropDirection">
            <option value="">All</option>
            <option value="intra">Incoming</option>
            <option value="iese">Outgoing</option>
          </select>

          <select name="dropTime" id="dropTime">
            <option value="">All</option>
            <option value="zi">Day</option>
            <option value="saptamana">Week</option>
            <option value="luna">Month</option>
            <option value="trimestru">3 Months</option>
            <option value="semestru">6 Months</option>
            <option value="an">Year</option>
          </select>

          <select name="dropLocation" id="dropLocation">
            <option value="">All</option>
            <option value="camera1s">Camera 1</option>
            <option value="camera2s">Camera 2</option>
            <option value="camera3s">Camera 3</option>
            <option value="camera4s">Camera 4</option>
            <option value="camera5s">Camera 5</option>
            <option value="camera6s">Camera 6</option>
            <option value="camera7s">Camera 7</option>
            <option value="camera8s">Camera 8</option>
          </select>

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <button type="submit">Select</button>

        </form>

        <?php

        if ($date[0] == NULL && $date[1] == NULL && $date[2] == NULL) {
		include '../resources/views/tools/storagecharts.blade.php';
		echo '<div id="chartContainer" style="height: 100%; width: 100%; position: none; "></div>';
	}
	if ($date[0] == NULL && $date[1] == NULL && $date[2] != NULL) {
	 	include '../resources/views/tools/storagecharts.blade.php';
		echo '<div id="chartContainer" style="height: 100%; width: 100%; position: none; "></div>';
	}
        
	if ($date[0] == NULL && $date[1] == 'an' && $date[2] == NULL) {
	include '../resources/views/tools/storagechartsYears.blade.php';
	echo '<div id="chartContainer" style="height: 100%; width: 100%; "></div>';
echo $GLOBALS['intrate_2010'];
	}
?>


       

      </div>
 <?php include '../resources/views/tools/footer.blade.php';?>

    </body>
</html>
