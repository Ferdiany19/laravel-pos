<?php

namespace App\Exports;

use App\models\StockRetur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockReturExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $stock_returs = StockRetur::all();
        return view('excel.excelStockRetur',['stock_returs' => $stock_returs]);
    }
}
