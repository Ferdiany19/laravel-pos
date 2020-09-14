<?php

namespace App\Exports;

use App\models\Item;
use App\models\StockItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BelumTerjualExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $item = Item::all();
        $belum_terjuals = StockItem::all();
        return view('excel.excelBelumTerjual',['belum_terjuals' => $belum_terjuals,'item' => $item]);
    }
}
