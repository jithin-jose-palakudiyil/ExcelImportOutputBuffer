<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SeriesExport implements FromView, WithTitle 
{
 
    public function __construct($series,$view_blade)
    {
        $this->series = $series;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'series' => $this->series, 
        ]);
    }
    
      /**
     * @return string
     */
    public function title(): string
    {
        return 'Series';
    } 
 
 
}
