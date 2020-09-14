<?php

namespace App\Exports;

use App\models\Item;
use App\models\OrderDetail;
use App\models\StockItem;
use App\models\StockRetur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengeluaranExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item = Item::all();
        $pengeluarans = StockItem::all();
        $pengeluarans = $pengeluarans->mergeRecursive(OrderDetail::all());
        $pengeluarans = $pengeluarans->mergeRecursive(StockRetur::where('retur_dari','g')->get());
        return view('excel.excelPengeluaran',['pengeluarans' => $pengeluarans,'item' => $item]);
    }
}
