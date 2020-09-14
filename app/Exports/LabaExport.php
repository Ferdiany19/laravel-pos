<?php

namespace App\Exports;

use App\models\Item;
use App\models\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LabaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item = Item::all();
        $pemasukans = OrderDetail::all();
        return view('excel.excelLaba',['item' => $item,'pemasukans' => $pemasukans]);
    }
}
