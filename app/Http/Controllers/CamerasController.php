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
//use Excel;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\CollectionExport;

global $export_var;

$export_in;
$export_out;


class CamerasController extends Controller
{


  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $export_var[] = array( 'From' , 'To' , 'Incoming_car' , 'Outgoing_car');




      $datadela = request()->get('from');
      $datala = request()->get('to');
      $direction = request()->get('dropDirection');
      $timedela = request()->get('dropTimeFrom');
      $timela = request()->get('dropTimeTo');
      $type = request()->get('dropType');
      $location = request()->get('dropLocation');

      global $datadl;
      global $datal;
      global $error;

      $error = NULL;

      $datadl = $datadela;
      $datal = $datala;

      global $intervalcond;
      global $lim_ore;
      global $lim_luna;
      global $lim_an;



      $export_in[] = array( 'From ' , ' To ' , ' Incoming cars ');
      $export_out[] = array( 'From ' , ' To ' , ' Outgoing cars ');





      $dela = $datadela . " " . $timedela;
      $la = $datala . " " . $timela;



      $ora_const = 60*60;
      $zi_const = $ora_const*24;
      $saptamana_const = $zi_const*14;
      $an_nb_const = $zi_const*365;
      $an_b_const = $zi_const*366;
      $an_const = 0;

      $interval_d = ( strtotime($datala) - strtotime($datadela) ) / $zi_const ;
      $interval_h = ( strtotime($timela) - strtotime($timedela) + 1 ) / $ora_const ;

      $intervalcond = strtotime($datala) - strtotime($datadela);
      $lim_ore = 60*60*24*14;
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

      $count_h = 0;

      $nr_ore_interval = $interval_h * $interval_d;
      $nr_zile_interval = $interval / $zi_const;
      $nr_week_interval = $interval / strtotime("+1 week",0);
      $nr_month_interval = $interval / strtotime("+1 month",0);
      $nr_3month_interval = $interval / strtotime("+3 month",0);
      $nr_6month_interval = $interval / strtotime("+6 month",0);
      $nr_year_interval = $interval / strtotime("+1 year",0);

      $crview = DB::statement('CREATE OR REPLACE VIEW cameraview as SELECT  * FROM camera1s UNION SELECT * FROM camera2s UNION SELECT * FROM camera3s UNION SELECT * FROM camera4s UNION SELECT * FROM camera5s UNION SELECT * FROM camera6s UNION SELECT * FROM camera7s UNION SELECT * FROM camera8s;');


      if($type == "ore" || $type == "zile" || $type == "saptamani"){


      if($type == "ore" && $datadela == NULL && $datala == NULL){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim 14 zile pentru tipul Hours!');</script>";



      }elseif($type == "ore" && $intervalcond > $lim_ore){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim 14 zile pentru tipul Hours!');</script>";


      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          //if($car1[0]->intrate != 0 || $car2[0]->iesite != 0){
          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);
      //  }


        }

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && ($timedela != "00:00:00" || $timela != "23:59:59")){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);


        }

      }elseif($type == "ore" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "ore" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "ore" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && $timedela != NULL && $timela != NULL){

        for($i=0;$i<$nr_ore_interval;$i++){

          if (($i-($count_h*$interval_h)) == $interval_h) {

            $count_h ++;

          }

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+(($i-($count_h*$interval_h))*$ora_const)+($zi_const*$count_h));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($datacount1)+($ora_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }


      if($type == "zile" && $datadela == NULL && $datala == NULL){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim 3 luni pentru tipul Days!');</script>";


      }elseif($type == "zile" && $intervalcond > $lim_luna){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim 3 luni pentru tipul Days!');</script>";


      }elseif($type == "zile" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "zile" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
    			$dataPoints1[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "zile" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "zile" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_zile_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }


      if($type == "saptamani" && $datadela == NULL && $datala == NULL){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim un an pentru tipul Weeks!');</script>";


      }elseif($type == "saptamani" && $intervalcond > $lim_an){

          $error = 1;
          echo "<script>alert('Alegeti un interval de maxim un an pentru tipul Weeks!');</script>";


      }elseif($type == "saptamani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week",strtotime("+$i week", strtotime($dela)-1)));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "saptamani" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week",strtotime("+$i week", strtotime($dela)-1)));
          $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints1[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car1[0]->intrate);
          $dataPoints2[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car2[0]->iesite);

          $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

        }

      }elseif($type == "saptamani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week",strtotime("+$i week", strtotime($dela)-1)));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }elseif($type == "saptamani" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

        for($i=0;$i<$nr_week_interval;$i++){

          $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i week", strtotime($dela)));
          $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 week",strtotime("+$i week", strtotime($dela)-1)));
          $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
          $dataPoints[$i] = array("label"=> date('d/m/Y H:i',strtotime($datacount1)), "y"=> $car[0]->ii);}

      }

      }


      if($type == "luni" || $type == "trimestre" || $type == "semestre" || $type == "ani"){

        if($type == "luni" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month",strtotime("+$i month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "luni" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month",strtotime("+$i month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "luni" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month",strtotime("+$i month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "luni" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_month_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 month",strtotime("+$i month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "trimestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $j = 3 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month",strtotime("+$j month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "trimestre" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $j = 3 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month",strtotime("+$j month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "trimestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $j = 3 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month",strtotime("+$j month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "trimestre" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_3month_interval;$i++){

            $j = 3 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+3 month",strtotime("+$j month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "semestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $j = 6 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month",strtotime("+$j month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "semestre" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $j = 6 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month",strtotime("+$j month", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "semestre" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $j = 6 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month",strtotime("+$j month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "semestre" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_6month_interval;$i++){

            $j = 6 * $i;
            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$j month", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+6 month",strtotime("+$j month", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('M/Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }


        if($type == "ani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year",strtotime("+$i year", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_car' => $car1[0]->intrate , 'Outgoing_car' => $car2[0]->iesite);

          }

        }elseif($type == "ani" && $direction == NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $$datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year",strtotime("+$i year", strtotime($dela)-1)));
            $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
            $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND locatieCar = '$location' AND timestampCar between '$datacount1' and '$datacount2' ");
      			$dataPoints1[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
            $dataPoints2[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);

            $export_var[$i] = array( 'From' => $datacount1 , 'To' => $datacount2 , 'Incoming_cars' => $car1[0]->intrate , 'Outgoing_cars' => $car2[0]->iesite);

          }

        }elseif($type == "ani" && $direction == NULL && $location == NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year",strtotime("+$i year", strtotime($dela)-1)));
            $car = DB::select("SELECT COUNT(*) as ii FROM cameraview WHERE directieCar = '$direction' AND timestampCar between '$datacount1' and '$datacount2' ");
            $dataPoints[$i] = array("label"=> date('Y',strtotime($datacount1)), "y"=> $car[0]->ii);}

        }elseif($type == "ani" && $direction != NULL && $location != NULL && $datadela != NULL && $datala != NULL && (($timedela == NULL && $timela == NULL) || ($timedela == "00:00:00" && $timela == "23:59:59"))){

          for($i=0;$i<$nr_year_interval;$i++){

            $datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year",strtotime("+$i year", strtotime($dela)-1)));$datacount1 = date( 'Y-m-d H:i:s' ,strtotime("+$i year", strtotime($dela)));
            $datacount2 = date( 'Y-m-d H:i:s' ,strtotime("+1 year",strtotime("+$i year", strtotime($dela)-1)));
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


      $date = [$direction, $type, $location, $dela, $la, $timedela, $timela, $datadela, $datala, $error, $export_var];
        if($date[9] != NULL){return view('report')->with('date',$date);}else{return view('report')->with('date',$date);}

    }

    public function export()
    {
        return Excel::download(new CollectionExport(), 'export.xlsx');
    }

    function excel()
    {
      return Excel::download(new CollectionExport(), 'export.xlsx');

      //    Excel::create('Exportfile' , function($excel) use ($export_var){
      //      $excel->setTitle('Exportfile');
      //      $excel->shet('Exportfile' , function($sheet) use ($export_var){
      //        $sheet->formArray($export_var, null, 'A1', false, false);
      //      });
      //    })->download('xlsx');
      //
      // echo "<script>alert('Alegeti un interval de maxim 14 zile pentru tipul Hours!');</script>";

     //    $customer_data = DB::table('tbl_customer')->get()->toArray();
     // $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
     // foreach($customer_data as $customer)
     // {
     //  $customer_array[] = array(
     //   'Customer Name'  => $customer->CustomerName,
     //   'Address'   => $customer->Address,
     //   'City'    => $customer->City,
     //   'Postal Code'  => $customer->PostalCode,
     //   'Country'   => $customer->Country
     //  );
     // }
     // Excel::create('Customer Data', function($excel) use ($customer_array){
     //  $excel->setTitle('Customer Data');
     //  $excel->sheet('Customer Data', function($sheet) use ($customer_array){
     //   $sheet->fromArray($customer_array, null, 'A1', false, false);
     //  });
     // })->download('xlsx');

     // $products = Product::select('name','description','price')->get()->toArray();
     //    return \Excel::create('Products', function($excel) use ($products) {
     //        $excel->sheet('Product Details', function($sheet) use ($products)
     //        {
     //            $sheet->fromArray($products);
     //        });
     //    })->download('xlsx');
     //
     //    $export_var[] = array( 'From ' => $datacount1 , ' To ' => $datacount2 , ' Incoming cars ' => $car1[0]->intrate , ' Outgoing cars ' => $car2[0]->iesite);
     //
     // return Excel::download(new CollectionExport, 'export.xlsx');


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
