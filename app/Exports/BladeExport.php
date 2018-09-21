<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BladeExport implements ShouldAutoSize, FromView
{


    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }



    public function view(): View
    {
        return view('exports.xml', [
            'data' => $this->data
        ]);
    }
}
