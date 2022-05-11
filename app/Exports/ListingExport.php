<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ListingExport implements FromView , WithTitle
{
 
    public function __construct($listing,$view_blade)
    {
        $this->listing = $listing;
        $this->view_blade = $view_blade;
    }

    
    public function view(): View
    {
        $view_blade = $this->view_blade;
        return view($view_blade, [
            'listing' => $this->listing, 
        ]);
    }
    
      /**
     * @return string
     */
    public function title(): string
    {
        return 'Listing';
    }  
 
 
}
