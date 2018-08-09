<?php

    function func_cond(){

      $datadela = request()->get('from');
      $datala = request()->get('to');
      $type = request()->get('dropType');

      $intervalcond = strtotime($datala) - strtotime($datadela;
      $lim_ore = 60*60*24*7;
      $lim_luna = 60*60*24*92;
      $lim_an = 60*60*24*366;

      if($type == "ore" && $datadela == NULL && $datala == NULL){

          alert("Alegeti un interval de maxim 7 zile!");

      }elseif($type == "ore" && $intervalcond > $lim_ore){

          alert("Alegeti un interval de maxim 7 zile!");

      }elseif($type == "zile" && $datadela == NULL && $datala == NULL){

          alert("Alegeti un interval de maxim 3 luni!");

      }elseif($type == "zile" && $intervalcond > $lim_luna){

          alert("Alegeti un interval de maxim 3 luni!");

      }elseif($type == "saptamani" && $datadela == NULL && $datala == NULL){

          alert("Alegeti un interval de maxim un an!");

      }elseif($type == "saptamani" && $intervalcond > $lim_an){

          alert("Alegeti un interval de maxim un an!");

      }else{

          action('CamerasController@index');

      }


    }


?>
<script> alert("Alegeti un interval de maxim 7 zile!"); </script>


$intervalcond = strtotime($datala) - strtotime($datadela);
$lim_ore = 60*60*24*7;
$lim_luna = 60*60*24*92;
$lim_an = 60*60*24*366;

if($type == "ore" && $datadela == NULL && $datala == NULL){

    Alert::message("Alegeti un interval de maxim 7 zile!");

}elseif($type == "ore" && $intervalcond > $lim_ore){

    Alert::message("Alegeti un interval de maxim 7 zile!");

}elseif($type == "zile" && $datadela == NULL && $datala == NULL){

    Alert::message("Alegeti un interval de maxim 3 luni!");

}elseif($type == "zile" && $intervalcond > $lim_luna){

    Alert::message("Alegeti un interval de maxim 3 luni!");

}elseif($type == "saptamani" && $datadela == NULL && $datala == NULL){

    Alert::message("Alegeti un interval de maxim un an!");

}elseif($type == "saptamani" && $intervalcond > $lim_an){

    Alert::message("Alegeti un interval de maxim un an!");

}else{

    Alert::message('CamerasController@index');

}

{{ action('CamerasController@index') }}

if($direction == NULL && $type != NULL && $location == NULL){

for($i=0;$i<$nr_zile_interval;$i++){

  $datacount1 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const));
  $datacount2 = date( 'Y-m-d H:i:s' ,strtotime($dela)+($i*$zi_const+$zi_const-1));
  $car1 = DB::select("SELECT COUNT(*) as intrate FROM cameraview WHERE directieCar = 'intra' AND timestampCar between '$datacount1' and '$datacount2' ");
  $car2 = DB::select("SELECT COUNT(*) as iesite FROM cameraview WHERE directieCar = 'iese' AND timestampCar between '$datacount1' and '$datacount2' ");
  $dataPoints1[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car1[0]->intrate);
  $dataPoints2[$i] = array("label"=> date('d/m/Y',strtotime($datacount1)), "y"=> $car2[0]->iesite);
}
}
