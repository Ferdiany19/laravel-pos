<?php

namespace App\Exports;

use App\models\Supplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SupplierExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $suppliers = Supplier::all();
        return view('excel.excelSupplier',['suppliers' => $suppliers]);
    }
}
