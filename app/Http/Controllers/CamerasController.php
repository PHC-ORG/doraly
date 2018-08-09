<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camera1;
use App\Camera2;
use App\Camera3;
use App\Camera4;
use App\Camera5;
use App\Camera6;
use App\Camera7;
use App\Camera8;
use DB;
use Illuminate\Support\Facades\Redirect;

class CamerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



      $datadela = request()->get('from');
      $datala = request()->get('to');
      $direction = request()->get('dropDirection');
      $timedela = request()->get('dropTimeFrom');
      $timela = request()->get('dropTimeTo');
      $type = request()->get('dropType');
      $location = request()->get('dropLocation');

      global $datadl;
      global $datal;



      $datadl = $datadela;
      $datal = $datala;

      global $intervalcond;
      global $lim_ore;
      global $lim_luna;
      global $lim_an;








      $dela = $datadela . " " . $timedela;
      $la = $datala . " " . $timela;

      $date = [$direction, $type, $location, $dela, $la, $timedela, $timela, $datadela, $datala];

      $ora_const = 60*60;
      $zi_const = $ora_const*24;
      $saptamana_const = $zi_const*7;
      $an_nb_const = $zi_const*365;
      $an_b_const = $zi_const*366;
      $an_const = 0;

      $intervalcond = strtotime($datala) - strtotime($datadela);
      $lim_ore = 60*60*24*7;
      $lim_luna = 60*60*24*92;
      $lim_an = 60*60*24*366;

      $interval = strtotime($la) - strtotime($dela) + 1;

      // global $nr_ore_interval;
      // global $nr_zile_interval;
      global $intrate;
      global $iesite;
      global $dataPoints;
      global $dataPoints1;
      global $dataPoints2;



      $nr_ore_interval = $interval / $ora_const;
      $nr_zile_interval = $interval / $zi_const;
      $nr_week_interval = $interval / strtotime("1 week");
      $nr_month_interval = $interval / strtotime("1 month");
      $nr_3month_interval = $interval / strtotime("3 month");
      $nr_6month_interval = $interval / strtotime("6 month");
      $nr_year_interval = $interval / strtotime("1 year");

      $crview = DB::statement('CREATE OR REPLACE VIEW cameraview as SELECT  * FROM camera1s UNION SELECT * FROM camera2s UNION SELECT * FROM camera3s UNION SELECT * FROM camera4s UNION SELECT * FROM camera5s UNION SELECT * FROM camera6s UNION SELECT * FROM camera7s UNION SELECT * FROM camera8s;');


      if($type == "ore" || $type == "zile" || $type == "saptamani"){


      if($type == "ore" && $datadela == NULL && $datala == NULL){

          echo "<script>alert('Alegeti un interval de maxim 7 zile!');</script>";
          return Redirect::to('reports');


      }elseif($type == "ore" && $intervalcond > $lim_ore){

          echo "<script>alert('Alegeti un interval de maxim 7 zile!');</script>";
          return Redirect::to('reports')->with('message', 'Login Failed');

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && ($timedela != "00:00:00" || $timela != "23:59:59")){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "ore" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "ore" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$ora_const+$ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }


      if($type == "zile" && $datadela == NULL && $datala == NULL){

          echo "<script>alert('Alegeti un interval de maxim 3 luni!');</script>";
          return Redirect::to('reports');

      }elseif($type == "zile" && $intervalcond > $lim_luna){

          echo "<script>alert('Alegeti un interval de maxim 3 luni!');</script>";
          return Redirect::to('reports');

      }elseif($type == "zile" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "zile" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "zile" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "zile" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }


      if($type == "saptamani" && $datadela == NULL && $datala == NULL){

          echo "<script>alert('Alegeti un interval de maxim un an!');</script>";
          return Redirect::to('reports');

      }elseif($type == "saptamani" && $intervalcond > $lim_an){

          echo "<script>alert('Alegeti un interval de maxim un an!');</script>";
          return Redirect::to('reports');

      }elseif($type == "saptamani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "saptamani" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

      }elseif($type == "saptamani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "saptamani" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week", strtotime($dela)-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }

      }


      if($type == "luni" || $type == "trimestre" || $type == "semestre" || $type == "ani"){

        if($type == "luni" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "luni" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "luni" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "luni" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "trimestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "trimestre" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "trimestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "trimestre" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "semestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "semestre" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "semestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "semestre" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "ani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "ani" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)-1));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);}

        }elseif($type == "ani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "ani" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year", strtotime($dela)-1));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }

      }


      if($direction == NULL && $type == NULL && $location == NULL && $datadela == NULL && $datala == NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59")) ){

        $car1 = DB::select('SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = "intra"');
        $car2 = DB::select('SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = "iese"');

        $intrate = $car1[0]->intrate;
        $iesite = $car2[0]->iesite;

      }


      if($direction == NULL && $type == NULL && $location != NULL && $datadela == NULL && $datala == NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59")) ){

        $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location'");
        $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location'");

        $intrate = $car1[0]->intrate;
        $iesite = $car2[0]->iesite;

      }





        return view('report')->with('date',$date);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
