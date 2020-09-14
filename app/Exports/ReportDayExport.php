<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDayExport implements FromView
{

    protected $items;
    protected $date;

    public function __construct($items,$date)
    {
        $this->items = $items;
        $this->date = $date;
    }

    public function view(): View
    {
        return view('excel.excelReportDay',['items' => $this->items,'date' => $this->date]);
    }
}
