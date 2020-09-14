<?php

namespace App\Exports;

use App\models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockOutExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $orders = Order::all();
        return view('excel.excelStockOut',['orders' => $orders]);
    }
}
