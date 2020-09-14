<?php

namespace App\Exports;

use App\models\Item;
use App\models\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PemasukanExport implements FromView
{
    public function view(): View
    {
        $item = Item::all();
        $pemasukans = OrderDetail::all();
        return view('excel.excelPemasukan',['pemasukans' => $pemasukans,'item' => $item]);
    }
}
