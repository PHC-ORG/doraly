@extends('layouts.app')

@section('content')



        <div class="content-page">





          <form class="form-fil" action="{{ action('CamerasController@index') }}">

            <br>
            <label class="filtru-l">Type</label>
            <br>
            <select name="dropType" id="dropType" class="filtru-isb-select"  onchange="showfil()">
              <option value="" selected>All</option>
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
            <div id="area1" style="display:none;">
            <label class="filtru-l">Date:</label>
            <br>
            <label class="labelDP" for="from">from</label>
            <br>
            <input type="text" id="from" name="from" class="filtru-isb-input-date" autocomplete="off">
            <br>
            <label class="labelDP" for="to">to</label>
            <br>
            <input type="text" id="to" name="to" class="filtru-isb-input-date" autocomplete="off">

            <div id="area2" style="display:none;">

            <br>
            <br>
            <label class="filtru-l">Time:</label>
            <br>
            <label class="filtru-l">from</label>
            <br>
            <select name="dropTimeFrom" id="dropTimeFrom" class="filtru-isb-select">
              <option value="00:00:00" selected>00:00</option>
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
            <select name="dropTimeTo" id="dropTimeTo" class="filtru-isb-select">
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
              <option value="23:59:59" selected>23:59</option>
            </select>

            </div>

            <br>
            <br>
            <label class="filtru-l">Direction</label>
            <br>
            <select name="dropDirection" id="dropDirection" class="filtru-isb-select">
              <option value="" selected>All</option>
              <option value="intra">Incoming</option>
              <option value="iese">Outgoing</option>
            </select>
            <br>
            <br>

            </div>

            <label class="filtru-l">Location</label>
            <br>
            <select name="dropLocation" id="dropLocation" class="filtru-isb-select">
              <option value="" selected>All</option>
              <option value="camera1">Pavilion P6</option>
              <option value="camera2">Pavilion P7</option>
              <option value="camera3"> - </option>
              <option value="camera4">BRD</option>
              <option value="camera5">IDEA BANK</option>
              <option value="camera6">IDEA</option>
              <option value="camera7">Pavilion R</option>
              <option value="camera8">Pavilion ABC</option>
            </select>
            <br>
            <br>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a href="reports" class="filtru-isb-button2">Reset</a>
            <br>
            <br>
            <button type="reset" class="filtru-isb-button">Clear All</button>
            <br>
            <br>
            <button type="submit" class="filtru-isb-button">Select</button>
            <br>
            <br>
            <!-- <a href="{{action('CamerasController@store')}}" class="filtru-isb-button3">Export</a> -->
            <!-- <br>
            <br> -->
            <div>
              <input type="checkbox" id="excel" name="excel"
               value="scales"  />
               <label for="scales">Export Excel</label>
             </div>
            <br>



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

             include '../resources/views/tools/storagechartsbarsDo.blade.php';
  		       echo '<div id="chartContainer" class="charts"></div>';

           }


       ?>







</div>

<script>

  function showfil() {

    var x = document.getElementById("dropType").value;

    if (x === "") {

      document.getElementById("area1").style.display='none';
      document.getElementById("area2").style.display='none';

    }
    if (x === "ore") {

      document.getElementById("area1").style.display='block';
      document.getElementById("area2").style.display='block';

    }
    if (x === "zile" || x === "saptamani" || x === "luni" || x === "trimestre" || x === "semestre" || x === "ani") {

      document.getElementById("area1").style.display='block';
      document.getElementById("area2").style.display='none';

    }


  }

   function functie() {


   }

</script>



@endsection
