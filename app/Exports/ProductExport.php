<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductExport implements FromView , WithTitle
{
 
    public function __construct($product,$view_blade)
    {
        $this->product = $product;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'product' => $this->product, 
        ]);
    }
    
      /**
     * @return string
     */
    public function title(): string
    {
        return 'Product';
    }  
 
 
}
