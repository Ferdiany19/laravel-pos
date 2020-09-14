<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportMonthExport implements FromView
{
    protected $items;
    protected $month;

    public function __construct($items,$month)
    {
        $this->items = $items;
        $this->month = $month;
    }


    public function view(): View
    {
        return view('excel.excelReportMonth',['items' => $this->items,'month' => $this->month]);
    }
}
