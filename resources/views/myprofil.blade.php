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

      <div class="content-page">


        {{ Form::open(['action' => 'TestController@index', $filtru->id]) }}

            {{Form::label('typel', 'Type')}}

            {{Form::select('type', ['' => 'All', 'ore' => 'Hours', 'zile' => 'Days', 'saptamani' => 'Weeks', 'luni' => 'Months', 'trimestre' => '3 Months', 'semestre' => '6 Months', 'ani' => 'Years'], '')}}



            {{Form::date('name', \Carbon\Carbon::now())}}



            {{Form::submit('Filtreaza')}}

        {{ Form::close() }}



      </div>

      <?php include '../resources/views/tools/footer.blade.php';?>

    </body>

</html>
