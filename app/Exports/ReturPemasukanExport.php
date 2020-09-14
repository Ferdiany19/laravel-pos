<?php

namespace App\Exports;

use App\models\Item;
use App\models\StockRetur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReturPemasukanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item = Item::all();
        $retur_pemasukans = StockRetur::where('retur_dari','c')->get();
        return view('excel.excelReturPemasukan',['item' => $item,'retur_pemasukans' => $retur_pemasukans]);
    }
}
