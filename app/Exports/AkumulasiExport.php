<?php

namespace App\Exports;

use App\models\OrderDetail;
use App\models\StockItem;
use App\models\StockRetur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AkumulasiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $pemasukan = OrderDetail::all()->sum('price');
        $belum_terjual = StockItem::all()->sum('price');
        $laba = OrderDetail::all()->sum('laba');
        $retur_pengeluaran = StockRetur::where('retur_dari','g')->sum('price');
        $pengeluaran = $belum_terjual + ($pemasukan - $laba) + $retur_pengeluaran;
        $retur_pemasukan = StockRetur::where('retur_dari','c')->sum('price');
        return view('excel.excelAkumulasi',[
            'pemasukan' => $pemasukan,
            'belum_terjual' => $belum_terjual,
            'laba' => $laba,
            'retur_pengeluaran' => $retur_pengeluaran,
            'pengeluaran' => $pengeluaran,
            'retur_pemasukan' => $retur_pemasukan
        ]);
    }
}
