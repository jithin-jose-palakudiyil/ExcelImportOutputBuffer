<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
 
class ExcelExport implements WithMultipleSheets
{
    use Exportable;

    protected $queue;
    
    public function __construct(object $chunks)
    {
        $this->chunks = $chunks;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        
        $sheets = [];
        $collection =    $this->chunks;
        foreach ($collection as $key => $value) :
            $view_blade= 'export.multiple_sheets_export';
            $sheets[] = new ExcelMultipleSheetsExport($value, $view_blade);
        endforeach;
 
        return $sheets;
    }
}