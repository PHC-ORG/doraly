<!doctype html>

<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">

        <script type="text/javascript" src="/js/canvasjs.js"></script>
        <script type="text/javascript" src="/js/raports.js"></script>

        <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">

        <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>


        @extends('tools.datepicker')


    </head>

    <body>

	    @extends('tools.menu')

        <div class="content-page">





          <form action="{{ action('CamerasController@index') }}">

            <br>
            <label class="filtru-l">Type</label>
            <br>
            <select name="dropType" id="dropType" class="filtru-isb">
              <option value="" selected="selected">All</option>
              <option value="ore">Hours</option>
              <option value="zile">Days</option>
              <option value="saptamani">Weeks</option>
              <option value="luni">Months</option>
              <option value="trimestre">3 Months</option>
              <option value="semestre">6 Months</option>
              <option value="ani">Years</option>
            </select>
            <br>
            <br>

            <label class="filtru-l">Date:</label>
            <br>
            <label class="labelDP" for="from">from</label>
            <br>
            <input type="text" id="from" name="from" class="filtru-isb" value="{{$GLOBALS['datadl']}}" autocomplete="off">
            <br>
            <label class="labelDP" for="to">to</label>
            <br>
            <input type="text" id="to" name="to" class="filtru-isb" value="{{$GLOBALS['datal']}}" autocomplete="off">
            <br>
            <br>
            <label class="filtru-l">Time:</label>
            <br>
            <label class="filtru-l">from</label>
            <br>
            <select name="dropTimeFrom" id="dropTimeFrom" class="filtru-isb">
              <option value="00:00:00" selected="selected">00:00</option>
              <option value="01:00:00">01:00</option>
              <option value="02:00:00">02:00</option>
              <option value="03:00:00">03:00</option>
              <option value="04:00:00">04:00</option>
              <option value="05:00:00">05:00</option>
              <option value="06:00:00">06:00</option>
              <option value="07:00:00">07:00</option>
              <option value="08:00:00">08:00</option>
              <option value="09:00:00">09:00</option>
              <option value="10:00:00">10:00</option>
              <option value="11:00:00">11:00</option>
              <option value="12:00:00">12:00</option>
              <option value="13:00:00">13:00</option>
              <option value="14:00:00">14:00</option>
              <option value="15:00:00">15:00</option>
              <option value="16:00:00">16:00</option>
              <option value="17:00:00">17:00</option>
              <option value="18:00:00">18:00</option>
              <option value="19:00:00">19:00</option>
              <option value="20:00:00">20:00</option>
              <option value="21:00:00">21:00</option>
              <option value="22:00:00">22:00</option>
              <option value="23:00:00">23:00</option>
            </select>
            <br>
            <label class="filtru-l">to</label>
            <br>
            <select name="dropTimeTo" id="dropTimeTo" class="filtru-isb">
              <option value="00:59:59">00:59</option>
              <option value="01:59:59">01:59</option>
              <option value="02:59:59">02:59</option>
              <option value="03:59:59">03:59</option>
              <option value="04:59:59">04:59</option>
              <option value="05:59:59">05:59</option>
              <option value="06:59:59">06:59</option>
              <option value="07:59:59">07:59</option>
              <option value="08:59:59">08:59</option>
              <option value="09:59:59">09:59</option>
              <option value="10:59:59">10:59</option>
              <option value="11:59:59">11:59</option>
              <option value="12:59:59">12:59</option>
              <option value="13:59:59">13:59</option>
              <option value="14:59:59">14:59</option>
              <option value="15:59:59">15:59</option>
              <option value="16:59:59">16:59</option>
              <option value="17:59:59">17:59</option>
              <option value="18:59:59">18:59</option>
              <option value="19:59:59">19:59</option>
              <option value="20:59:59">20:59</option>
              <option value="21:59:59">21:59</option>
              <option value="22:59:59">22:59</option>
              <option value="23:59:59" selected="selected">23:59</option>
            </select>
            <br>
            <br>
            <label class="filtru-l">Location</label>
            <br>
            <select name="dropLocation" id="dropLocation" class="filtru-isb">
              <option value="" selected="selected">All</option>
              <option value="camera1">Camera 1</option>
              <option value="camera2">Camera 2</option>
              <option value="camera3">Camera 3</option>
              <option value="camera4">Camera 4</option>
              <option value="camera5">Camera 5</option>
              <option value="camera6">Camera 6</option>
              <option value="camera7">Camera 7</option>
              <option value="camera8">Camera 8</option>
            </select>
            <br>
            <br>
            <label class="filtru-l">Direction</label>
            <br>
            <select name="dropDirection" id="dropDirection" class="filtru-isb">
              <option value="" selected="selected">All</option>
              <option value="intra">Incoming</option>
              <option value="iese">Outgoing</option>
            </select>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <br>
            <br>
            <button type="reset" class="filtru-isb">Clear All</button>
            <br>
            <br>
            <button type="submit" class="filtru-isb">Select</button>
            <br>
            {{$GLOBALS['intervalcond']}}
            <br>
            {{$GLOBALS['lim_ore']}}
            <br>
            {{$GLOBALS['lim_luna']}}
            <br>
            {{$GLOBALS['lim_an']}}
            <br>
            {{strtotime("+1 month",$GLOBALS['lim_an'])}}
            <br>
            {{strtotime("+3 month",$GLOBALS['lim_an'])}}
            <br>
            {{strtotime("+6 month",$GLOBALS['lim_an'])}}
            <br>
            {{$GLOBALS['intervalcond']/strtotime("+1 year",0)}}
            <br>
            {{strtotime("/6 month",$GLOBALS['lim_an'])}}
            <br>
            {{strtotime("/1 month",$GLOBALS['lim_an'])}}



          </form>







        <?php



          if ($date[0] == NULL && $date[1] == NULL && $date[9] == NULL) {

             include '../resources/views/tools/storagecharts.blade.php';
		         echo '<div id="chartContainer" class="charts"></div>';

           }elseif ($date[0] == NULL && $date[1] != NULL && $date[9] == NULL) {

             include '../resources/views/tools/storagechartsbars.blade.php';
		         echo '<div id="chartContainer" class="charts"></div>';

           }elseif ($date[0] == 'intra' && $date[1] != NULL && $date[9] == NULL) {

             include '../resources/views/tools/storagechartsbarsDi.blade.php';
	           echo '<div id="chartContainer" class="charts"></div>';

           }elseif ($date[0] == 'iese' && $date[1] != NULL && $date[9] == NULL) {

             include '../resources/views/tools/storagecharts.blade.php';
  		       echo '<div id="chartContainer" class="charts"></div>';

           }



       ?>




</div>


      @extends('tools.footer')

    </body>

</html>
