<?php

namespace App\Http\Controllers;


use App\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportExcelController extends Controller
{

    function export()
    {

      return \Excel::download(new App\Exports\UsersExport, 'user.xlsx');

    }

}
