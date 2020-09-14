<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportYearExport implements FromView
{
    protected $items;
    protected $year;

    public function __construct($items,$year)
    {
        $this->items = $items;
        $this->year = $year;
    }


    public function view(): View
    {
        
        return view('excel.excelReportYear',['items' => $this->items,'year' => $this->year]);
    }
}
