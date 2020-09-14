<?php

namespace App\Exports;

use App\models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $customers = Customer::all();
        return view('excel.excelCustomer',['customers' => $customers]);
    }
}
