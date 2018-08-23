<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection, WithHeadings
{
   use Exportable;

   public function collection()
   {
       return $GLOBALS['$export_var'];
   }

   public function headings(): array
   {
       return [
           'From',
           'To',
           'Incoming',
           'Outgoing',
       ];
   }



}
