<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

use App\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportExcelController extends Controller
{

    function export()
    {

      return Excel::download(new CollectionExport(), 'export.xlsx');

    }

}
