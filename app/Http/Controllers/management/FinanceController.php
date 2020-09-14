<?php

namespace App\Http\Controllers\management;

use App\Http\Controllers\Controller;
use App\models\Item;
use App\models\OrderDetail;
use App\models\StockItem;
use App\models\StockRetur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AkumulasiExport;
use App\Exports\BelumTerjualExport;
use App\Exports\LabaExport;
use App\Exports\PemasukanExport;
use App\Exports\PengeluaranExport;
use App\Exports\ReturPemasukanExport;
use App\Exports\ReturPengeluaranExport;

class FinanceController extends Controller
{

    public function export_pdf()
    {
        $pemasukan = OrderDetail::all()->sum('price');
        $belum_terjual = StockItem::all()->sum('price');
        $laba = OrderDetail::all()->sum('laba');
        $retur_pengeluaran = StockRetur::where('retur_dari','g')->sum('price');
        $pengeluaran = $belum_terjual + ($pemasukan - $laba) + $retur_pengeluaran;
        $retur_pemasukan = StockRetur::where('retur_dari','c')->sum('price');
        $pdf = \PDF::loadView('pdf.pdfAkumulasi',[
            'pemasukan' => $pemasukan,
            'belum_terjual' => $belum_terjual,
            'laba' => $laba,
            'retur_pengeluaran' => $retur_pengeluaran,
            'pengeluaran' => $pengeluaran,
            'retur_pemasukan' => $retur_pemasukan
        ])->setPaper('a4','Landscape');
        return $pdf->download('akumulasi.pdf');
    }


    public function export_excel()
    {
        return Excel::download(new AkumulasiExport, 'akumulasi.xlsx');
    }

    public function akumulasi_index(){
        $pemasukan = OrderDetail::all()->sum('price');
        $belum_terjual = StockItem::all()->sum('price');
        $laba = OrderDetail::all()->sum('laba');
        $retur_pengeluaran = StockRetur::where('retur_dari','g')->sum('price');
        $pengeluaran = $belum_terjual + ($pemasukan - $laba) + $retur_pengeluaran;
        $retur_pemasukan = StockRetur::where('retur_dari','c')->sum('price');
        return view('management.finance.akumulasi')->with([
            'pemasukan' => $pemasukan,
            'belum_terjual' => $belum_terjual,
            'laba' => $laba,
            'retur_pengeluaran' => $retur_pengeluaran,
            'pengeluaran' => $pengeluaran,
            'retur_pemasukan' => $retur_pemasukan
        ]);
    }


    public function pengeluaran_export_pdf()
    {
        $item = Item::all();
        $pengeluarans = StockItem::all();
        $pengeluarans = $pengeluarans->mergeRecursive(OrderDetail::all());
        $pengeluarans = $pengeluarans->mergeRecursive(StockRetur::where('retur_dari','g')->get());
        $pdf = PDF::loadView('pdf.pdfPengeluaran',['pengeluarans' => $pengeluarans,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('pengeluaran.pdf');
    }

    public function pengeluaran_export_excel()
    {
        return Excel::download(new PengeluaranExport, 'pengeluaran.xlsx');
    }


    public function pemasukan_export_pdf()
    {
        $item = Item::all();
        $pemasukans = OrderDetail::all();
        $pdf = PDF::loadView('pdf.pdfPemasukan',['pemasukans' => $pemasukans,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('pemasukan.pdf');
    }


    public function pemasukan_export_excel()
    {
        return Excel::download(new PemasukanExport, 'pemasukan.xlsx');
    }


    public function laba_export_pdf()
    {
        $item = Item::all();
        $pemasukans = OrderDetail::all();
        $pdf = PDF::loadView('pdf.pdfLaba',['pemasukans' => $pemasukans,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('laba.pdf');
    }


    public function laba_export_excel()
    {
        return Excel::download(new LabaExport, 'laba.xlsx');
    }


    public function belum_terjual_export_pdf()
    {
        $item = Item::all();
        $belum_terjuals = StockItem::all();
        $pdf = PDF::loadView('pdf.pdfBelumTerjual',['belum_terjuals' => $belum_terjuals,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('belum_terjual.pdf');
    }

    public function belum_terjual_export_excel()
    {
        return Excel::download(new BelumTerjualExport, 'belum_terjual.xlsx');
    }

    public function retur_pemasukan_export_pdf()
    {
        $item = Item::all();
        $retur_pemasukans = StockRetur::where('retur_dari','c')->get();
        $pdf = PDF::loadView('pdf.pdfReturPemasukan',['retur_pemasukans' => $retur_pemasukans,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('retur_pemasukan.pdf');
    }

    public function retur_pemasukan_export_excel()
    {
        return Excel::download(new ReturPemasukanExport, 'retur_pemasukan.xlsx');
    }

    public function retur_pengeluaran_export_pdf()
    {
        $item = Item::all();
        $retur_pengeluarans = StockRetur::where('retur_dari','g')->get();
        $pdf = PDF::loadView('pdf.pdfReturPengeluaran',['retur_pengeluarans' => $retur_pengeluarans,'item' => $item])->setPaper('a4','Landscape');
        return $pdf->download('retur_pengeluaran.pdf');
    }


    public function retur_pengeluaran_export_excel()
    {
        return Excel::download(new ReturPengeluaranExport, 'retur_pengeluaran.xlsx');
    }

    public function pengeluaran_index(){
        $item = Item::all();

        // ---------- pengeluarans ----------------------
        $pengeluarans = StockItem::all();
        $pengeluarans = $pengeluarans->mergeRecursive(OrderDetail::all());
        $pengeluarans = $pengeluarans->mergeRecursive(StockRetur::where('retur_dari','g')->get());

        // ---------- pemasukan ------------------------
        $pemasukans = OrderDetail::all();

        // ----------- Belum Terjual ------------------
        $belum_terjuals = StockItem::all();

        // ------------- retur Pemasukan ------------
        $retur_pemasukans = StockRetur::where('retur_dari','c')->get();
        // ------------ retur Pengeluaran ----------
        $retur_pengeluarans = StockRetur::where('retur_dari','g')->get();

        return view('management.finance.pengeluaran')->with([
            'pengeluarans' => $pengeluarans,
            'pemasukans' => $pemasukans,
            'belum_terjuals' => $belum_terjuals,
            'retur_pemasukans' => $retur_pemasukans,
            'retur_pengeluarans' => $retur_pengeluarans,
            'item' => $item
        ]);
    }
}
