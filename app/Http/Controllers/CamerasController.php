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

class CamerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
	$direction = request()->get('dropDirection');
      	$time = request()->get('dropTime');
      	$location = request()->get('dropLocation');
      	$date = [$direction, $time, $location];
	global $intrate;
	global $iesite;
	if($direction == NULL && $time == NULL && $location == NULL)
	{
	$car1 = DB::select('SELECT COUNT(*) as intrate FROM((SELECT * FROM camera1s as i1 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera2s as i2 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera3s as i3 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera4s as i4 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera5s as i5 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera6s as i6 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera7s as i7 WHERE directieCar = "intra") UNION
				(SELECT * FROM camera8s as i8 WHERE directieCar = "intra")) as intrate');
	$car2 = DB::select('SELECT COUNT(*) as iesite FROM((SELECT * FROM camera1s as i1 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera2s as i2 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera3s as i3 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera4s as i4 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera5s as i5 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera6s as i6 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera7s as i7 WHERE directieCar = "iese") UNION
				(SELECT * FROM camera8s as i8 WHERE directieCar = "iese")) as iesite');
	$intrate = $car1[0]->intrate;
	$iesite = $car2[0]->iesite;
	}

	if($direction == NULL && $time == NULL && $location !=NULL)
	{
	$car1 = DB::select("SELECT COUNT(*) as intrate FROM camera1s WHERE directieCar = 'intra'");
	$car2 = DB::select("SELECT COUNT(*) as iesite FROM camera2s WHERE directieCar = 'iese'");
	$intrate = $car1[0]->intrate;
	$iesite = $car2[0]->iesite;
	}
	
	if($direction == NULL && $time != NULL && $location == NULL)
	{
		if($time == 'an')
		{
			$car1 = DB::select("SELECT (SELECT COUNT(*) as intrate FROM((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59')) as pl) as intrate_2010,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59')) as pl) as intrate_2011,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59')) as pl) as intrate_2012,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59')) as pl) as intrate_2013,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59')) as pl) as intrate_2014,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59')) as pl) as intrate_2015,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59')) as pl) as intrate_2016,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59')) as pl) as intrate_2017,
			(SELECT COUNT(*) as intrate FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'intra' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59')) as pl) as intrate_2018");
		
			$car2 = DB::select("SELECT (SELECT COUNT(*) as iesite FROM((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2010-01-01 00:00:00' and '2010-12-31 23:59:59')) as pl) as iesite_2010,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2011-01-01 00:00:00' and '2011-12-31 23:59:59')) as pl) as iesite_2011,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2012-01-01 00:00:00' and '2012-12-31 23:59:59')) as pl) as iesite_2012,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2013-01-01 00:00:00' and '2013-12-31 23:59:59')) as pl) as iesite_2013,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2014-01-01 00:00:00' and '2014-12-31 23:59:59')) as pl) as iesite_2014,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2015-01-01 00:00:00' and '2015-12-31 23:59:59')) as pl) as iesite_2015,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2016-01-01 00:00:00' and '2016-12-31 23:59:59')) as pl) as iesite_2016,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2017-01-01 00:00:00' and '2017-12-31 23:59:59')) as pl) as iesite_2017,
			(SELECT COUNT(*) as iesite FROM ((SELECT * FROM camera1s as pl1 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera2s as pl2 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera3s as pl3 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION 
			(SELECT * FROM camera4s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera5s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera6s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera7s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59') UNION
			(SELECT * FROM camera8s as pl4 WHERE directieCar = 'iese' AND timestampCar between '2018-01-01 00:00:00' and '2018-12-31 23:59:59')) as pl) as iesite_2018");
			
			global $intrate_2010, $intrate_2011, $intrate_2012, $intrate_2013, $intrate_2014, $intrate_2015, $intrate_2016, $intrate_2017, $intrate_2018;
			global $iesite_2010, $iesite_2011, $iesite_2012, $iesite_2013, $iesite_2014, $iesite_2015, $iesite_2016, $iesite_2017, $iesite_2018;
			$intrate_2010 = $car1[0]->intrate_2010; 
			$intrate_2011 = $car1[0]->intrate_2011;
			$intrate_2012 = $car1[0]->intrate_2012;
			$intrate_2013 = $car1[0]->intrate_2013;
			$intrate_2014 = $car1[0]->intrate_2014;
			$intrate_2015 = $car1[0]->intrate_2015;
			$intrate_2016 = $car1[0]->intrate_2016;
			$intrate_2017 = $car1[0]->intrate_2017;
			$intrate_2018 = $car1[0]->intrate_2018;
			
			$iesite_2010 = $car2[0]->iesite_2010; 
			$iesite_2011 = $car2[0]->iesite_2011;
			$iesite_2012 = $car2[0]->iesite_2012;
			$iesite_2013 = $car2[0]->iesite_2013;
			$iesite_2014 = $car2[0]->iesite_2014;
			$iesite_2015 = $car2[0]->iesite_2015;
			$iesite_2016 = $car2[0]->iesite_2016;
			$iesite_2017 = $car2[0]->iesite_2017;
			$iesite_2018 = $car2[0]->iesite_2018;

		}
	}
      	return view('raports')->with('date',$date);
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
