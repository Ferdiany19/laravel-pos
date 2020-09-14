<?php

namespace App\Exports;

use App\models\Item;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockInExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $items = Item::all();
        return view('excel.excelStockIn',['items' => $items]);
    }
}
