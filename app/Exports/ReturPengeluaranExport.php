<?php

namespace App\Exports;

use App\models\Item;
use App\models\StockRetur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReturPengeluaranExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item = Item::all();
        $retur_pengeluarans = StockRetur::where('retur_dari','g')->get();
        return view('excel.excelReturPengeluaran',['item' => $item,'retur_pengeluarans' => $retur_pengeluarans]);
    }
}
