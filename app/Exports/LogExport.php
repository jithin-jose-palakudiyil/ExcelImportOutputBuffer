<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
 
class LogExport implements WithMultipleSheets
{
    use Exportable;

    protected $queue;
    
    public function __construct(object $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        
        $sheets = [];
        if(isset($this->queue->PivotQueue)): 
            $series= $this->queue->PivotQueue->where('sheet','series');
            $series_view_blade= 'export.series_log_export';
            $sheets[] = new SeriesExport($series, $series_view_blade);
            
            $product= $this->queue->PivotQueue->where('sheet','product');
            $product_view_blade= 'export.product_log_export';
            $sheets[] = new ProductExport($product, $product_view_blade);
            
            $listing= $this->queue->PivotQueue->where('sheet','listing');
            $listing_view_blade= 'export.listing_log_export';
            $sheets[] = new ListingExport($listing, $listing_view_blade);
            
            
        endif;
        

        
        
//        $sheets[] = new \Modules\Group\Exports\SeriesExport($ranklist, $view_blade);
        
        return $sheets;
    }
}