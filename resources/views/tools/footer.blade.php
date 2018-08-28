<footer class="footer">

    <?php

      date_default_timezone_set("Europe/Bucharest");

      $data_up = DB::select("SELECT updated_at as updated FROM status_app WHERE idstatus_app = 1 ");

      $current_data = strtotime(date('Y-m-d H:i:s'));

      $data_update = strtotime($data_up[0]->updated);

      $status_time = $current_data - $data_update;

      if($status_time <= 15){

          $status = 'OK';
          $color_status = 'green';

      }else{

          $status = 'FAILED';
          $color_status = 'red';

      }

    ?>

    <label class="footer-status"> Status :</label> <label class="footer-s" style="color: {{$color_status}} ;"> {{$status}} </label>
    <p class="footerp">© 2018 PHILRO Control S.R.L.</p>

</footer>
