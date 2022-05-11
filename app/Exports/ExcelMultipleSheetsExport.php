<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExcelMultipleSheetsExport implements FromView 
{
 
    public function __construct($collection,$view_blade)
    {
        $this->collection = $collection;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'collection' => $this->collection, 
        ]);
    }
    
   
 
}
